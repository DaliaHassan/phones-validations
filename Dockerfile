FROM php:7.3-fpm-alpine

RUN apk update \
    && apk add  --no-cache git curl libmcrypt libmcrypt-dev openssh-client icu-dev nodejs yarn \
    libxml2-dev freetype-dev libpng-dev libjpeg-turbo-dev g++ make autoconf \
    && docker-php-source extract \
    && docker-php-source delete \
    && docker-php-ext-install pdo soap intl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && rm -rf /tmp/*

CMD ["php-fpm", "-F"]

COPY composer.json /var/www/phones-validations/

COPY composer.lock /var/www/phones-validations/

WORKDIR /var/www/phones-validations

RUN composer install

EXPOSE 9000