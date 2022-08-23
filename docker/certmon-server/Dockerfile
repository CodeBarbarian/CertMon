FROM php:8.1-apache

RUN apt-get update
RUN apt-get -y install curl
RUN apt-get -y install nano
RUN apt-get -y install git

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Get composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy over the composer file
#COPY composer.json /var/www/html/composer.json

# Composer specific
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN chown -R www-data:www-data /var/www/html

#WORKDIR /var/www/html