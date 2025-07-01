FROM php:8.1-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    libzip-dev \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libssl-dev \
    libxml2-dev && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo_mysql zip exif pcntl mysqli mbstring phar bcmath xml gd

# Xdebug (igual que tu configuración)

RUN pecl install xdebug && docker-php-ext-enable xdebug

# Instalar composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar composer files primero para cache
COPY composer.json composer.lock /var/www/

# Instalar dependencias composer
RUN composer install --optimize-autoloader --no-dev

# Copiar el resto del código
COPY . /var/www

# Crear usuario www-data y asignar permisos
RUN groupadd -g 1000 www && \
    useradd -u 1000 -ms /bin/bash -g www www && \
    chown -R www:www /var/www/storage /var/www/bootstrap/cache

USER www

EXPOSE 9000

CMD ["php-fpm"]
