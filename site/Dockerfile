FROM wordpress:6.8.3-php8.3-apache@sha256:30bff39330d1693b0ce13d32fc9b7bb67193064f040b7d60d3494e136fa599d4
COPY theme /usr/src/wordpress/wp-content/themes/uh-gcs
COPY plugins /usr/src/wordpress/wp-content/mu-plugins
RUN a2enmod rewrite
HEALTHCHECK --interval=30s --timeout=5s --start-period=120s --retries=3 CMD php -r '$s=@fsockopen("127.0.0.1",80,$e,$m,4); if(!$s)exit(1);fclose($s);'
