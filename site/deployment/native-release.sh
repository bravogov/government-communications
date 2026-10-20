#!/usr/bin/env bash
# GitHub-authoritative GCS release preparation and private runtime; no Coolify or Forgejo.
set -Eeuo pipefail
umask 0077
ACTION="${1:-}"
SHA="${2:-}"
[[ "$EUID" -eq 0 ]] || { echo 'Run as root on the authorised OVH VPS.' >&2; exit 2; }
[[ "$ACTION" == prepare || "$ACTION" == deploy ]] || { echo 'Usage: native-release.sh prepare|deploy EXACT_GITHUB_MAIN_SHA' >&2; exit 2; }
[[ "$SHA" =~ ^[0-9a-f]{40}$ ]] || { echo 'Exact 40-character approved BravoGov GitHub SHA required.' >&2; exit 2; }
SOURCE='/srv/uhde/source/gcs-government-communications-github'
SOURCE_URL='https://github.com/bravogov/government-communications.git'
REL='site'
RELEASE="/srv/uhde/releases/gcs-professional/$SHA"
ENV_FILE='/etc/uhde/gcs-professional/production.env'
STATE_DIR='/var/lib/uhde/gcs-professional'
BACKUP_ROOT='/var/lib/uhde/backups/gcs-professional'
install -d -m 0750 /srv/uhde/source
if [[ ! -d "$SOURCE/.git" ]]; then
  git clone --no-tags "$SOURCE_URL" "$SOURCE"
fi
[[ "$(git -C "$SOURCE" remote get-url origin)" == "$SOURCE_URL" ]] || { echo 'GCS checkout is not the authorised GitHub source.' >&2; exit 2; }
git -C "$SOURCE" fetch --no-tags origin '+refs/heads/main:refs/remotes/origin/main'
git -C "$SOURCE" cat-file -e "$SHA^{commit}"
git -C "$SOURCE" merge-base --is-ancestor "$SHA" refs/remotes/origin/main || { echo 'SHA is not on authoritative BravoGov GitHub main.' >&2; exit 2; }
exec 9>/run/lock/uhde-gcs-professional-release.lock
flock -x 9
if [[ ! -f "$RELEASE/.release-sha" ]]; then
  install -d -m 0750 /srv/uhde/releases/gcs-professional
  TMP="${RELEASE}.new.$$"
  install -d -m 0750 "$TMP"
  trap 'rm -rf "${TMP:-/nonexistent}"' EXIT
  git -C "$SOURCE" archive "$SHA" "$REL" | tar -xf - -C "$TMP"
  [[ -f "$TMP/$REL/compose.yaml" && -f "$TMP/$REL/Dockerfile" ]] || { echo 'Incomplete release.' >&2; exit 2; }
  printf '%s\n' "$SHA" >"$TMP/.release-sha"
  chmod -R go-w "$TMP"
  mv -T "$TMP" "$RELEASE"
  trap - EXIT
fi
[[ "$(cat "$RELEASE/.release-sha")" == "$SHA" ]] || { echo 'Release pointer mismatch.' >&2; exit 2; }
APP="$RELEASE/$REL"
COMPOSE=(docker compose --project-name uh-gcs-professional -f "$APP/compose.yaml")
GCS_RELEASE_SHA="$SHA" GCS_DB_PASSWORD='validation-not-a-credential' GCS_DB_ROOT_PASSWORD='validation-not-a-credential' "${COMPOSE[@]}" config --quiet
echo "GCS_GITHUB_SOURCE_VALIDATED $SHA"
if [[ "$ACTION" == prepare ]]; then
  echo 'Prepared only. Production containers and public routes unchanged.'
  exit 0
fi
[[ -f "$ENV_FILE" ]] || { echo 'Dedicated /etc/uhde/gcs-professional/production.env not present.' >&2; exit 2; }
[[ "$(stat -c '%u:%a' "$ENV_FILE")" == '0:600' ]] || { echo 'Credentials must be root-owned and mode 0600.' >&2; exit 2; }
install -d -m 0700 "$STATE_DIR" "$BACKUP_ROOT"
export GCS_RELEASE_SHA="$SHA"
COMPOSE=(docker compose --project-name uh-gcs-professional --env-file "$ENV_FILE" -f "$APP/compose.yaml")
"${COMPOSE[@]}" config --quiet
if docker ps --format '{{.Names}}' | grep -Fxq 'uh-gcs-professional-database-1'; then
  STAMP="$(date -u +%Y%m%dT%H%M%SZ)"
  BACKUP="$BACKUP_ROOT/gcs-$STAMP.sql"
  "${COMPOSE[@]}" exec -T database sh -c 'MYSQL_PWD="$MARIADB_PASSWORD" exec mariadb-dump --single-transaction -u "$MARIADB_USER" "$MARIADB_DATABASE"' >"$BACKUP"
  [[ -s "$BACKUP" ]] || { echo 'Database export failed; no release.' >&2; exit 2; }
  chmod 0600 "$BACKUP"
  sha256sum "$BACKUP" >"$BACKUP.sha256"
fi
"${COMPOSE[@]}" build
# WordPress base image declares an anonymous /var/www/html volume. Renew it on each immutable release
# so PHP, themes and plugins match the approved source SHA; the database and uploads use named volumes.
"${COMPOSE[@]}" up -d --no-build --renew-anon-volumes --wait --wait-timeout 180
docker image inspect "uh/gcs-professional:$SHA" --format '{{.Id}}' >"$STATE_DIR/image-id"
printf '%s\n' "$SHA" >"$STATE_DIR/installed-source-sha"
chmod 0600 "$STATE_DIR/"*
echo "GCS_NATIVE_PRIVATE_RUNTIME_DEPLOYED $SHA"
echo 'DNS, Caddy public route and GOV.UH professional link remain unchanged.'
