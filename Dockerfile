# Etapa 1 - Imagem base com PHP, Composer, Node, npm
FROM laravelsail/php82-composer AS base

# Instalações adicionais
RUN apt-get update && apt-get install -y \
    sqlite3 \
    unzip \
    curl \
    libzip-dev \
    && docker-php-ext-install zip pdo_sqlite

# Instala Node.js e npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Cria diretório do app
WORKDIR /var/www

# Copia arquivos da aplicação
COPY . .

# Define permissões (ajuste para seu user/app)
RUN chown -R www-data:www-data /var/www && chmod -R 775 /var/www

# Expõe a porta padrão usada no startCommand do Render
EXPOSE 10000

# Define comando default, sobrescrito no render.yaml
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "10000"]
