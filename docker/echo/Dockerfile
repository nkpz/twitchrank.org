FROM node:8-stretch-slim

WORKDIR /var/www

RUN set -x && \
  apt-get -y update && \
  apt-get install -y libicu-dev libpng-dev curl libcurl4-openssl-dev postgresql-server-dev-all

CMD cd /var/www && npm run echo
