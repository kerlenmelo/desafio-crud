# Imagem base com PHP 8.2 FPM
FROM php:8.2-fpm

# Instala dependências
RUN apt-get update && apt-get install -y \
    sqlite3 \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    git \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_sqlite zip

# Instala Composer (via imagem oficial)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cria diretório da aplicação
WORKDIR /var/www

# Copia arquivos da aplicação
COPY . .

# Ajusta permissões para Laravel
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Expõe porta usada pelo Laravel serve
EXPOSE 10000

# Comando padrão (pode ser sobrescrito no Render)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
