# Etapa 1: Node.js
FROM node:18 as node

# Etapa 2: PHP + Composer + dependências Laravel
FROM php:8.2-fpm

# Instala dependências de sistema
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

# Copia Node e npm da imagem anterior
COPY --from=node /usr/local/bin/node /usr/local/bin/
COPY --from=node /usr/local/bin/npm /usr/local/bin/

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# Instala dependências PHP e JS
RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
    && npm install \
    && npm run build

# Cria pastas necessárias e arquivo de banco
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p bootstrap/cache \
    && touch database/database.sqlite \
    && php artisan key:generate \
    && php artisan migrate --force

# Ajusta permissões
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 10000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
