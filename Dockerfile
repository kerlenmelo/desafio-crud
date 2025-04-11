# Etapa 1: Imagem base com Node.js e npm
FROM node:18 as node

# Etapa 2: Imagem base com PHP e Composer
FROM php:8.2-fpm

# Instala dependências do sistema
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
    && docker-php-ext-install pdo pdo_sqlite zip

# Copia o Node.js e npm da imagem anterior
COPY --from=node /usr/local/bin/node /usr/local/bin/
COPY --from=node /usr/local/bin/npm /usr/local/bin/

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define diretório de trabalho
WORKDIR /var/www

# Copia arquivos da aplicação
COPY . .

# Ajusta permissões
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Expõe a porta usada pelo Laravel
EXPOSE 10000

# Comando padrão
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
