FROM composer:latest AS build

WORKDIR /app

# composer install
COPY composer.json composer.lock /app/
RUN composer install --no-dev --no-interaction --no-progress --no-scripts

# copy the remainder of the application
# then optimize composer autoload
COPY . /app
COPY .env.prod .env
RUN composer dump-autoload -o && \
    php artisan optimize

FROM dunglas/frankenphp:latest

# install additional PHP extensions; add more if your application requires them
RUN install-php-extensions \
    pdo_pgsql \
    pgsql \
    redis \
    opcache \
    pcntl

WORKDIR /app

# composer install
COPY --from=build /app /app/

# expose the default octane/frankenphp port
EXPOSE 8000

# start the server when the container runs
ENTRYPOINT ["php", "artisan", "octane:start"]
