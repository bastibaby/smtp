FROM php:8.2-fpm

# Instalar dependencias del sistema y herramientas necesarias
RUN apt-get update && apt-get install -y \
    git unzip curl zip libpng-dev libonig-dev libxml2-dev libzip-dev \
    libjpeg62-turbo-dev libfreetype6-dev locales libssl-dev \
    jpegoptim optipng pngquant gifsicle \
    vim nginx supervisor cron default-mysql-client nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql zip exif pcntl mbstring bcmath xml gd mysqli \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

ARG XDEBUG_PORT=9003
ARG XDEBUG_MODE=develop,debug
ARG XDEBUG_IDEKEY=VSCODE
ARG XDEBUG_CLIENT_HOST=host.docker.internal

RUN echo "xdebug.client_port=${XDEBUG_PORT}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
 && echo "xdebug.mode=${XDEBUG_MODE}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
 && echo "xdebug.idekey=${XDEBUG_IDEKEY}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
 && echo "xdebug.client_host=${XDEBUG_CLIENT_HOST}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
 && echo "xdebug.log=/tmp/xdebug/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Crear carpeta para log Xdebug
RUN mkdir /tmp/xdebug && chmod -R 777 /tmp/xdebug

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

# Instalar Node.js y Yarn (última versión estable)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install --global yarn

# Crear usuario para Laravel/WordPress
RUN groupadd -g 1000 www && useradd -u 1000 -ms /bin/bash -g www www

# Setear directorio de trabajo
WORKDIR /var/www

# Copiar proyecto completo
COPY . /var/www
COPY --chown=www:www . /var/www

# Instalar dependencias JS y compilar assets
WORKDIR /var/www/htdocs/content/themes/meat-theme
RUN yarn install && yarn build

# Volver al directorio base Laravel
WORKDIR /var/www

# Instalar dependencias PHP
RUN composer install --no-interaction --optimize-autoloader --no-dev || true
RUN php artisan optimize:clear || true

# Asignar permisos
RUN chown -R www-data:www-data /var/www

# Configurar cron para Laravel
RUN echo "* * * * * www-data /usr/local/bin/php /var/www/artisan schedule:run >> /dev/null 2>&1" > /etc/cron.d/laravel

# Copiar configuración nginx y supervisord
COPY Docker/nginx/conf.d/nginx.conf /etc/nginx/sites-enabled/default
COPY Docker/supervisord.conf /etc/supervisord.conf

# Supervisor socket necesario
RUN mkdir -p /var/run && touch /var/run/supervisor.sock

# Exponer puerto para nginx
EXPOSE 80

# Iniciar supervisord (nginx + php-fpm)
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
