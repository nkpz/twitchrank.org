FROM php:7-apache

RUN set -x && \
  apt-get -y update && \
  apt-get install -y libicu-dev libpng-dev curl git libcurl4-openssl-dev postgresql-server-dev-all && \
  NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) && \
  docker-php-ext-install -j${NPROC} intl && \
  docker-php-ext-install -j${NPROC} pdo && \
  docker-php-ext-install -j${NPROC} gd && \
  docker-php-ext-install -j${NPROC} curl && \
  docker-php-ext-install -j${NPROC} pdo_pgsql && \
  curl -sS https://getcomposer.org/installer | php && \
  mv composer.phar /usr/local/bin/composer && \
  a2enmod rewrite && \
  service apache2 restart
