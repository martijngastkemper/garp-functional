FROM php:7.1-cli-alpine3.7

RUN apk add --no-cache \
        $PHPIZE_DEPS \
    && pecl install xdebug-2.6.0 \
    && docker-php-ext-enable xdebug

RUN curl -O -L https://github.com/infection/infection/releases/download/0.9.0/infection.phar \
    && curl -O -L https://github.com/infection/infection/releases/download/0.9.0/infection.phar.pubkey \
    && mv infection.phar /usr/local/bin/ \
    && mv infection.phar.pubkey /usr/local/bin/ \
    && chmod +x /usr/local/bin/infection.phar

WORKDIR /app

CMD ["infection.phar"]
