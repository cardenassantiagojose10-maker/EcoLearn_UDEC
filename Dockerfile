# --- Etapa 1: compilar assets (Vite + Tailwind) ---
FROM node:22-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY . .
RUN npm run build

# --- Etapa 2: dependencias PHP ---
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs

# --- Etapa 3: imagen final ---
FROM php:8.3-cli-alpine
RUN apk add --no-cache sqlite-libs sqlite-dev \
    && docker-php-ext-install pdo_sqlite \
    && apk del sqlite-dev
WORKDIR /var/www
COPY . .
COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public/build ./public/build
RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && php artisan package:discover --ansi \
    && chmod +x docker/start.sh

ENV PORT=10000
EXPOSE 10000
CMD ["sh", "docker/start.sh"]
