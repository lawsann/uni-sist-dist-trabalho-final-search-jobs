FROM php:7.4-fpm-buster
LABEL maintainer="Fillipe Almeida Dutra <fillipe@querycommerce.com>" \
      Description="Servidor de aplicação criado para o trabalho final de Sistemas Distribuídos - UniBH / UNA." \
      Version="1.0.0"

RUN apt-get update && apt-get install -y \
  cron \
  git \
  gzip \
  default-mysql-client \
  vim \
  zip \
  libxml2 \
  libxml2-dev \
  curl \
  wget

RUN docker-php-ext-install \
  ctype \
  iconv \
  intl \
  json \
  pdo_mysql \
  session \
  tokenizer \
  xml

# sjobs user/group, its home folder and its permissions
RUN groupadd -g 1000 sjobs \
    && useradd -g sjobs -u 1000 -d /home/sjobs -s /bin/bash sjobs

RUN mkdir -p /sock /var/www /home/sjobs \
    && chown -R sjobs:sjobs /usr/local/etc/php/conf.d /sock /home/sjobs /var/www

# downloads and installs composer
RUN curl -sS https://getcomposer.org/installer | \
    php -- --2 --install-dir=/usr/local/bin --filename=composer

# downloads and installs symfony cli
RUN echo 'deb [trusted=yes] https://repo.symfony.com/apt/ /' | tee /etc/apt/sources.list.d/symfony-cli.list
RUN apt-get update && apt-get install -y symfony-cli

# uploads php configs to container
COPY conf/php.ini /usr/local/etc/php/
COPY conf/www.conf /usr/local/etc/php-fpm.d/

# inits default executions settings
USER sjobs:sjobs
VOLUME /var/www/
WORKDIR /var/www/
