FROM php:7.4.0-fpm

RUN apt-get update \
 && apt-get install -y git

RUN curl -sS https://getcomposer.org/installer | php \
 && mv composer.phar /usr/local/bin/composer

WORKDIR /usr/local/docker/app

RUN composer config -g repos.packagist composer https://packagist.jp \
 && composer global require hirak/prestissimo

COPY ./composer.json /usr/local/docker/app/composer.json
RUN composer install

COPY ./src /usr/local/docker/app/src
COPY ./index.php /usr/local/docker/app/index.php