FROM php:7-cli

RUN set -x && \
  apt-get -y update && \
  apt-get install -y libicu-dev libpng-dev curl libcurl4-openssl-dev postgresql-server-dev-all cron && \
  NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) && \
  docker-php-ext-install -j${NPROC} intl && \
  docker-php-ext-install -j${NPROC} pdo && \
  docker-php-ext-install -j${NPROC} gd && \
  docker-php-ext-install -j${NPROC} curl && \
  docker-php-ext-install -j${NPROC} pdo_pgsql

ADD crontab /etc/cron.d/smashstreams-cron

RUN touch /etc/crontab /etc/cron.*/* && \
chmod 0644 /etc/cron.d/smashstreams-cron && \
crontab /etc/cron.d/smashstreams-cron && \
touch /var/log/cron.log

CMD cron && tail -f /var/log/cron.log 
