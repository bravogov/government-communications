# Government Communications — United Hampshire

Source repository for the Government Communication Service's professional website.

**Responsible institution:** Government Communication Service, part of the Civil Service, with central professional leadership through the Cabinet Office.  
**Public site (not yet verified as live):** https://gcs.civilservice.gov.uhrblx.com/  
**Authoritative GOV.UH organisation profile:** https://www.gov.uhrblx.com/government/organisations/government-communication-service  
**UK functional/content comparator:** https://www.communications.gov.uk/  
**Status:** Development; no production release or public-service acceptance is implied by this repository.

## Product boundary

The public professional-information website provides information about the Service, standards, membership eligibility, careers, learning, professional resources and news. The real UK Government Communications website is a separate professional-information estate with an additional authenticated Connect membership product. UH must not imply it operates UK Connect, its membership directory, credentials, awards, staff courses, protected materials or personal-data facilities without separately established authority and live services.

GOV.UH Accord remains the authoritative publisher of the Government Communication Service organisation profile. This repo does not overwrite that profile, confer legal powers or create a new public body.

## Source and institutional controls

Code is maintained in the BravoGov GitHub organisation. Production currently remains controlled by the operative Forgejo/Coolify source-and-release instructions until the reviewed migration of production authority is complete. A GitHub commit alone is neither a deployment receipt nor a claim that the public website works. **Do not activate a second production release chain.**

The attached site candidate is an editable WordPress application with a dedicated theme and separate database. It is not automatically approved for publication; restore UK comparator fidelity in presentation and actual content before first public deployment. The reviewed X-GOVUK GOV.UK Eleventy plugin is useful for static professional guidance or project documentation, but does not substitute for an authenticated CMS or a member directory. Do not use UK Royal Arms, GOV.UK's crown/logotype or UK-only accounts. See docs/comparator-contract.md.

## Source layout

- `site/`: WordPress application, independent MariaDB service, native editorial theme, and initial draft content.
- `site/acceptance/smoke.py`: canonical HTTPS page and accessibility-structure checks, not evidence of successful release until executed against the real public host.
- `docs/comparator-contract.md`: UK product and UH editorial constraints.

## Acceptance

Requires lawful institutional ownership, accepted software source, pinned dependencies and digest, real CMS edit/review/publish testing, database backup and restore, separate DNS/TLS checks against both authoritative nameservers, responsiveness/accessibility review, real public HTTPS test, release receipt and functioning rollback. An HTTP 200 alone does not satisfy acceptance.

United Hampshire is a fictional digital civic community inspired by UK institutions and is not the UK Government.
