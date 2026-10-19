#!/usr/bin/env python3
"""Read-only, public canonical acceptance for UH Government Communications."""
from urllib.request import Request, urlopen
from urllib.error import URLError, HTTPError
from html.parser import HTMLParser
import ssl
import sys

BASE = "https://gcs.civilservice.gov.uhrblx.com"
PATHS = [
    ("/", "The professional body for government communicators"),
    ("/about/", "Government Communication Service"),
    ("/membership/", "professional community"),
    ("/careers/", "Civil Service Jobs"),
    ("/learning/", "professional development"),
    ("/standards/", "professional standards"),
    ("/resources/", "Resources and guidance"),
    ("/contact/", "Contact Government Communications"),
    ("/accessibility/", "Accessibility statement"),
    ("/privacy/", "Privacy and cookies"),
    ("/publication/communication-planning/", "Communication planning"),
    ("/publication/evaluating-communications/", "Evaluating communications"),
    ("/publication/accessible-communications/", "Accessible communication"),
    ("/news/", "News"),
    ("/publication/", "Publications"),
    ("/?s=communications", "Search results"),
]
class Headings(HTMLParser):
    def __init__(self):
        super().__init__()
        self.heading_count = 0
        self.has_main = False
    def handle_starttag(self, name, attrs):
        if name == "main":
            self.has_main = True
        if name == "h1":
            self.heading_count += 1
ctx = ssl.create_default_context()
errors=[]
for path, phrase in PATHS:
    url = BASE + path
    try:
        with urlopen(Request(url, headers={"User-Agent": "UH-GCS-Public-Acceptance/1.0"}), timeout=12, context=ctx) as r:
            page = r.read().decode("utf-8", "replace")
            parser=Headings()
            parser.feed(page)
            good = r.status == 200 and phrase.casefold() in page.casefold() and parser.has_main and parser.heading_count == 1
            print(("PASS" if good else "FAIL"),r.status,url,"main=",parser.has_main,"h1=",parser.heading_count)
            if not good:
                errors.append(url)
    except (URLError, HTTPError, OSError) as e:
        print("FAIL",url,str(e))
        errors.append(url)
if errors:
    print(f"NOT ACCEPTED: {len(errors)} canonical page checks failed.",file=sys.stderr)
    sys.exit(1)
print(f"ACCEPTED: {len(PATHS)} canonical HTTPS content checks passed.")