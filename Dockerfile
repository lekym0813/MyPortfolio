FROM php:8.2-apache

RUN apt-get update && apt-get install -y libpq-dev
RUN docker-php-ext-configure pdo_pgsql --with-pdo-pgsql=/usr
RUN docker-php-ext-install pdo_pgsql

RUN a2enmod rewrite

COPY . /var/www/html/

EXPOSE 80
