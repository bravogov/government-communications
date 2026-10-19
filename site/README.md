# Government Communication Service professional website

**Institution:** Government Communication Service (GCS), part of the Civil Service.
**Professional leadership:** Cabinet Office.
**Public hostname:** `gcs.civilservice.gov.uhrblx.com`.
**UK functional comparator:** `https://www.communications.gov.uk/` (successor to `gcs.civilservice.gov.uk`).
**Product:** Independent professional-information website. The GOV.UH organisation record remains the authoritative central government organisation profile.

## Application

WordPress with an isolated MariaDB database, an editable UH Government Communications theme and a one-time, idempotent initial-publication plugin. The application listens only on the VPS loopback address, 127.0.0.1:45836; the existing UH Caddy edge remains the sole public HTTPS route. Coolify is not a GCS dependency or deployer.

Publication covers the homepage, About, Membership, Careers, Learning, Standards, Resources, Contact, Accessibility, Privacy, three substantive professional guides and the native WordPress news, search and editorial administration systems. The content plugin publishes once only; subsequent amendments are made through the authenticated WordPress editor, never reset on an application update.

The site does **not** establish a new ministerial department, member identity provider, application approval service, private directory, scheduled training event, award, mailbox or press office. Those require their respective competent institutions and systems. The professional website is a distinct product from GCS's GOV.UH organisation page and Government Communications Headquarters.

## Controlled deployment — native UH software delivery

The authoritative source is the exact, immutable revision from bravogov/government-communications on GitHub. **Do not register, run or deploy GCS through Coolify.** GCS uses the existing OVH VPS, Docker Engine, systemd-controlled service operations, Caddy edge, UH source-control authority and product-owned databases. Docker Compose is a local application-runtime description, not a hosting provider or Coolify integration.

The controlled product files are compose.yaml, Dockerfile and deployment/native-release.sh. Run native-release.sh prepare EXACT_SHA to verify and materialise the source release without starting a production service. native-release.sh deploy EXACT_SHA uses the same immutable release to build the private application and start the isolated GCS WordPress/MariaDB containers directly under the native Docker runtime. The script refuses commits outside authoritative BravoGov GitHub main, preserves data volumes, exports the existing GCS database before subsequent deployments, and records the installed release SHA and image identity. No production deployment is approved simply by pushing source or preparing a release.

Store the two dedicated database credentials as GCS_DB_PASSWORD and GCS_DB_ROOT_PASSWORD in /etc/uhde/gcs-professional/production.env, owned by root with permissions 0600. Keep credentials and WordPress administrator details out of Git and Docker image layers. Never reuse the insidegovuh-wordpress database or volumes. The production runtime exposes only 127.0.0.1:45836 on the VPS; it is not attached to Coolify.

After secure private WordPress installation, current content approval, role checks and backup/restore evidence, the authorised existing Caddy service should load the reviewed GCS hostname route. Do not activate that route or publish the link before both authoritative DNS servers answer consistently, the public TLS certificate is valid and the official content is approved. The Caddy template is deployment/gcs-public.caddy.fragment; it must not be enabled as an unverified, duplicate production route. The GCS GOV.UH About us professional-website link is updated last through the native Accord editor after public read-back succeeds.

Routine updates must retain source SHA, resolved container image ID, publication/editor state, backup and rollback evidence. A rollback requires a prior validated application image and a compatible database snapshot; merely starting an older container does not prove a data-safe rollback. Public activation and editor acceptance are separate from preparation of the private runtime.

## Checks

1. Validate Compose (with redacted temporary values) and PHP lint before any deployment.
2. Verify unique database and persistent WordPress volumes under the newly managed resource, not an existing production service.
3. Verify editor sign-in, WordPress admin access, role permissions and site titles.
4. Run `python3 acceptance/smoke.py` against the exact canonical public hostname after production activation.
5. Inspect desktop and mobile rendering, keyboard navigation, search, page content, professional links and 404 behaviour.
6. Verify both authoritative DNS servers return the expected consistent A/AAAA and appropriate SOA serials, that public HTTPS presents a valid certificate and that Caddy routes exclusively to the GCS resource.
7. Confirm no UK Royal Arms, UK departmental logo, UK copyright notice, invented contact email or imitation of a UK government login is present.
8. Only after acceptance, update the GCS GOV.UH About us professional-website link through native Accord publishing and read back the published edition.

This README is implementation and acceptance material, not a claim that the website has been deployed.
