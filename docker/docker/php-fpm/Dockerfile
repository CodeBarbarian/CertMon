FROM php:8.2.0beta2-fpm-alpine3.16

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

CMD ["php-fpm"]

EXPOSE 9000