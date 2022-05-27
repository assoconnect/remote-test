FROM php:8.0-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
        acl \
        unzip \
    ; \
    rm -rf /var/lib/apt/lists/*

ARG APCU_VERSION=5.1.18
RUN BUILD_DEPS=" \
        zlib1g-dev \
        libzip-dev \
    "; \
    apt-get update && apt-get install -y --no-install-recommends $BUILD_DEPS ; \
    docker-php-ext-install -j$(nproc) \
        zip \
        pdo_mysql \
    ; \
    pecl install \
        apcu-${APCU_VERSION} \
    ; \
    docker-php-ext-enable \
        apcu \
        opcache \
    ; \
    pecl clear-cache; \
    apt-get remove -y $BUILD_DEPS ; \
    rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN ln -s $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini
COPY docker/php/conf.d/app.dev.ini $PHP_INI_DIR/conf.d/app.ini

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN set -eux; \
	composer global require "symfony/flex" --prefer-dist --no-progress --classmap-authoritative; \
	composer clear-cache
ENV PATH="${PATH}:/root/.composer/vendor/bin"

WORKDIR /usr/src/backend

COPY apps/backend/composer.json apps/backend/composer.lock apps/backend/symfony.lock ./
RUN set -eux; \
	composer install --prefer-dist --no-scripts --no-progress; \
	composer clear-cache

VOLUME /usr/src/backend/var

COPY docker/php/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]
