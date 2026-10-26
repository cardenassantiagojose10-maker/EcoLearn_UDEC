#!/bin/sh
set -e

# Render genera APP_KEY en base64 sin el prefijo que Laravel espera.
case "$APP_KEY" in
  base64:*) ;;
  "") export APP_KEY="base64:$(head -c 32 /dev/urandom | base64)" ;;
  *) export APP_KEY="base64:$APP_KEY" ;;
esac

# La base SQLite vive dentro del contenedor: se recrea y se puebla en cada arranque.
touch database/database.sqlite
php artisan migrate --force
php artisan db:seed --force

php artisan config:cache
php artisan route:cache
php artisan view:cache

exec php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"
