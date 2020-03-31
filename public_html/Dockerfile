FROM php:7.3.3-apache
RUN apt-get update && apt-get upgrade -y
RUN docker-php-ext-install mysqli pdo_mysql bcmath

RUN pecl install xdebug
COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN docker-php-ext-enable xdebug

EXPOSE 80