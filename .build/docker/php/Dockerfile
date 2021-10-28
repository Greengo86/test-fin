FROM php:7.4-zts

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug  \
    && docker-php-ext-install mysqli pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
CMD ["php", "-S", "0.0.0.0:8080", "index.php", "-t", "/app"]