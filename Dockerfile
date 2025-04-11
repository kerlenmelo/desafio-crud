# Etapa 1: Node.js para frontend build
FROM node:18 AS node

# Etapa 2: PHP + Composer + SQLite compatível
FROM php:8.2-fpm

# Instala pacotes necessários (incluindo libsqlite3-dev, não sqlite3 diretamente!)
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libsqlite3-dev \
    git \
    && docker-php-ext-install pdo pdo_sqlite zip

# Node.js e npm
COPY --from=node /usr/local/bin/node /usr/local/bin/
COPY --from=node /usr/local/bin/npm /usr/local/bin/

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# App
WORKDIR /var/www
COPY . .

RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

EXPOSE 10000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
