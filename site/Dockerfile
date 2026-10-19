FROM wordpress:7.1.3-php8.3-apache@sha256:81a34254acaa6ff3b9a67268c2745e9a041c4094cbe5ccd35b75ed3bbdc033b5
COPY theme /usr/src/wordpress/wp-content/themes/uh-gcs
COPY plugins /usr/src/wordpress/wp-content/mu-plugins
RUN a2enmod rewrite
HEALTHCHECK --interval=30s --timeout=5s --start-period=120s --retries=3 CMD php -r '$s=@fsockopen("127.0.0.1",80,$e,$m,4); if(!$s)exit(1);fclose($s);'