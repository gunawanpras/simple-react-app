from php:7.4.2

COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV APP_DIR=/var/www/app

WORKDIR /var/www/app
COPY . .
RUN apt-get update && apt-get install -y zip && composer install

ENTRYPOINT ["php", "${APP_DIR}/script.php"]