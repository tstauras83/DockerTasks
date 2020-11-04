FROM php:7.4.12-apache
RUN apt-get update && apt-get upgrade -y
RUN docker-php-ext-install mysqli pdo_mysql bcmath
RUN a2enmod rewrite
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN pecl install xdebug
COPY Docker/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN docker-php-ext-enable xdebug

ENV APACHE_DOCUMENT_ROOT /var/www/html/public_html
ENV APACHE_LOG_DIR /var/logs

RUN echo $APACHE_DOCUMENT_ROOT

COPY Docker/apache.conf /etc/apache2/sites-available/000-default.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html
COPY ./ /var/www/html/
RUN chown www-data:www-data -R .
RUN composer install --prefer-dist --no-plugins --no-scripts

RUN ls -al /var/www/html/

EXPOSE 80
