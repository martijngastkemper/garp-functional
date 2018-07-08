FROM php:7.1

RUN pecl install xdebug-2.6.0 \
    && docker-php-ext-enable xdebug \
    && curl -O https://github.com/infection/infection/releases/download/0.9.0/infection.phar \
    && curl -O https://github.com/infection/infection/releases/download/0.9.0/infection.phar.pubkey \
    && chmod +x infection.phar

WORKDIR /app
