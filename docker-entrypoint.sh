#!/bin/sh
set -eu

if [ -n "${APP_KEY:-}" ] && [ "${APP_KEY#base64:}" = "$APP_KEY" ]; then
    export APP_KEY="base64:$APP_KEY"
fi

port="${PORT:-10000}"
sed -ri "s/Listen 80/Listen ${port}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:80>/<VirtualHost *:${port}>/" /etc/apache2/sites-available/000-default.conf

php artisan migrate --force
php artisan db:seed --force

exec apache2-foreground
