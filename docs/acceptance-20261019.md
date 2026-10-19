# GCS professional website — isolated candidate acceptance, 19 October 2026

## Source and limits

Current development branch: `feature/professional-website`. The public GCS site has **not** been deployed and has **no verified public DNS/HTTPS route**. Verification below relates only to a local isolated WordPress and MariaDB deployment on the authorised OVH VPS. This record is testing evidence, not production clearance.

## Technical verification

- Pinned WordPress image: `wordpress:7.1.3-php8.3-apache@sha256:81a34254acaa6ff3b9a67268c2745e9a041c4094cbe5ccd35b75ed3bbdc033b5`.
- MariaDB: isolated `gcs_wp` database and `gcs_wordpress` and `gcs_db` private QA volumes. No public port. No production database or Caddy/DNS edited.
- `docker compose config --quiet`: PASS with locally supplied throwaway QA secrets.
- PHP syntax check of `theme/*.php` and `plugins/*.php`: PASS.
- `python3 -m py_compile site/acceptance/smoke.py`: PASS.
- WordPress installation: PASS; `get_bloginfo('version')` returned `7.1.3`.
- GCS theme activation: PASS.
- Native content: 12 core public pages, 4 professional publications, 4 classification topics.
- 13 local HTTP routes: PASS (home, About, Membership, Careers, Learning, Standards, Resources, Publications, single publication, Contact, Accessibility, Privacy, News).
- Publications query filtering: PASS (topic, text search and zero results).
- Native authenticated content workflow in isolated installation: draft created, amended, published, revision retained, withdrawn: PASS. QA-only administrator password generated and never placed in source.
- WordPress REST publications index: PASS, 4 published resources.
- Database backup and restoration: PASS. Both initial and restored test databases contain 20 post records (including 5 `gcs_publication` records, one QA fixture and 13 page records). Dump SHA-256 `48135177728ac9f4ff3114eb7929a0bc939a3ea3097caf8313d28e062c68d629`; 98,642 bytes; file permissions 0600.
- Desktop and mobile Chromium screenshots of homepage and desktop publications page inspected; navigation, heading hierarchy and filter layout present.

## Public production acceptance

This is not public completion. Required before release: UK comparator editorial and UH functional review; secure native CMS administration; Coolify resource registered through the existing authorised deployment authority using an immutable **Forgejo main SHA** until the controlling production-source migration is completed; separate database and product-local backup/restore; DNS answers from both authoritative servers; HTTPS and Caddy public routing; canonical website and editor regression; recorded release and rollback evidence. Only then update the existing Accord GCS About us website link.

No test passwords, database dumps, deployment tokens or administrator secrets are stored in this repository.

## Additional canonical-link regression

After correcting the accessible-communications publication to its actual plural canonical slug, all **17 distinct internal link destinations** in the 13-page isolated content crawl returned **HTTP 200**, with no unresolved internal links or unexpected redirects. Corrected the source seeder and public HTTPS smoke assertion; the existing QA CMS draft pages were amended through their native WordPress editor for readback. No public domain was changed.
