#!/bin/sh
set -e

# Arrancar PHP-FPM en background
php-fpm &

# Arrancar nginx en primer plano para que Fly pueda controlar el proceso principal
nginx -g 'daemon off;'
