FROM php:7.3.29-zts-alpine3.14

RUN apk add --no-cache $PHPIZE_DEPS curl \
    && docker-php-source extract \
    && pecl install parallel \
    && docker-php-ext-enable parallel \
    && docker-php-source delete \
    && rm -rf /tmp/*

RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin && \
    echo "alias composer='composer'" >> /root/.bashrc

COPY . /app
WORKDIR /app

RUN composer install -n --ansi

CMD [ "php", "./public/index.php" ]