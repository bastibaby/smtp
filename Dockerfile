FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git unzip curl zip libpng-dev libonig-dev libxml2-dev libzip-dev cron \
    && docker-php-ext-install pdo_mysql zip mbstring exif pcntl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-interaction --optimize-autoloader --no-dev
RUN php artisan optimize:clear

RUN chown -R www-data:www-data /var/www/html

RUN echo "* * * * * www-data /usr/local/bin/php /var/www/html/artisan schedule:run >> /dev/null 2>&1" > /etc/cron.d/laravel

COPY .fly/entrypoint.sh /entrypoint
RUN chmod +x /entrypoint

ENTRYPOINT ["/entrypoint"]
CMD ["php-fpm"]
