#!/usr/bin/env bash
set -e

echo "🔧 Iniciando build Laravel..."

composer install --no-interaction --prefer-dist --optimize-autoloader
npm install && npm run build

mkdir -p storage/framework/{sessions,views,cache}
mkdir -p bootstrap/cache

touch database/database.sqlite

php artisan key:generate
php artisan migrate --force

echo "✅ Build finalizado com sucesso!"
