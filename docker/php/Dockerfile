FROM php:7.2-fpm

WORKDIR /tmp

# Use the default development configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# installing extensions
RUN apt-get update && \
     apt-get install -y \
         libzip-dev \
         && docker-php-ext-install zip

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html/app