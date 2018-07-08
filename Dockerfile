FROM php:7.1

RUN pecl install xdebug-2.6.0 \
    && docker-php-ext-enable xdebug \
    && curl -O -L https://github.com/infection/infection/releases/download/0.9.0/infection.phar \
    && curl -O -L https://github.com/infection/infection/releases/download/0.9.0/infection.phar.pubkey \
    && cp infection.phar /usr/local/bin/ \
    && cp infection.phar.pubkey /usr/local/bin/ \
    && chmod +x /usr/local/bin/infection.phar

WORKDIR /app
