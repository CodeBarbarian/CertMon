FROM php:8.1-apache

RUN apt-get update
RUN apt-get -y install curl
RUN apt-get -y install nano
RUN apt-get -y install git

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER 1
COPY composer.json composer.json

RUN composer update
RUN composer dump-autoload

RUN chown -R www-data:www-data /var/www/html