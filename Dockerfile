# Etapa 1: Node.js para build frontend
FROM node:18 as node

# Etapa 2: PHP com Composer e extensões Laravel
FROM php:8.2-fpm

# Instala dependências de sistema + extensões necessárias do Laravel
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    git \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite zip bcmath

# Copia instalação completa do Node.js (incluindo npm funcional)
COPY --from=node /usr/local /usr/local

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define diretório base da aplicação
WORKDIR /var/www

# Copia todos os arquivos
COPY . .

# Instala dependências
RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
    && npm install \
    && npm run build

# Cria pastas de cache e banco
RUN mkdir -p storage/framework/{sessions,views,cache} bootstrap/cache \
    && touch database/database.sqlite \
    && php artisan key:generate \
    && php artisan migrate --force

# Permissões para Laravel
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# Porta usada pelo artisan serve
EXPOSE 10000

# Start padrão usado no Render
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
