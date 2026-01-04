FROM php:8.3-fpm-alpine
RUN apk add --no-cache libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip
WORKDIR /var/www/html
CMD ["php-fpm"]