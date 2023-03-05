FROM phpdockerio/php:8.2-fpm

### mouting volume
WORKDIR "/var/www/html"
RUN chown -R 1000:www-data /var/www/
RUN chmod -R 775 /var/www/

### install Extensions (PHP 8.1)
RUN apt-get update; \
    apt-get -y --no-install-recommends install \
        git \ 
        php8.2-amqp \ 
        php8.2-bcmath \ 
        php8.2-bz2 \ 
        php8.2-cgi \ 
        php8.2-dba \ 
        php8.2-decimal \ 
        php8.2-gmagick \ 
        php8.2-gmp \ 
        php8.2-gnupg \ 
        php8.2-grpc \ 
        php8.2-http \ 
        php8.2-imap \ 
        php8.2-inotify \ 
        php8.2-interbase \ 
        php8.2-intl \ 
        php8.2-mailparse \ 
        php8.2-mcrypt \ 
        php8.2-memcache \ 
        php8.2-memcached \ 
        php8.2-mongodb \ 
        php8.2-mysql \ 
        php8.2-oauth \ 
        php8.2-pgsql \ 
        php8.2-phpdbg \ 
        php8.2-pspell \
        php8.2-raphf \
        php8.2-redis \ 
        php8.2-soap \ 
        php8.2-sqlite3 \ 
        php8.2-ssh2 \ 
        php8.2-uuid \ 
        php8.2-xdebug \ 
        php8.2-xmlrpc \ 
        php8.2-yaml \ 
        php8.2-zmq; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

### install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin
RUN mv /usr/local/bin/composer.phar /usr/local/bin/composer

### set timezone
ENV TZ=Europe/Paris
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone