FROM php:8.2.1-fpm-alpine3.16

RUN apk add --no-cache --virtual .phpize-deps-configure $PHPIZE_DEPS \
    && apk add linux-headers

RUN apk update && apk add \
    sudo \
    icu-dev \
    nodejs \
    npm \
    freetype-dev \
	libjpeg-turbo-dev \
	libpng-dev \
    libzip-dev \
    openssh \
    musl-dev \
    make \
    php8-dev \
    php8-pear \
    gcc \
    imagemagick-dev

RUN docker-php-ext-install \
    pdo_mysql \
    intl \
    zip \
    exif

RUN pecl install imagick
RUN pecl install -o -f xdebug  \
    && docker-php-ext-enable xdebug

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-enable imagick

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./ /var/www/public_html

COPY ./_docker/phprun/php.ini /usr/local/etc/php/conf.d/php.ini

WORKDIR /var/www/public_html

RUN addgroup -g 1000 dev && adduser -G dev -g dev -s /bin/sh -D dev

RUN mkdir -p /etc/sudoers.d

RUN echo '%dev ALL=(ALL) NOPASSWD: ALL' > /etc/sudoers.d/dev

USER dev


