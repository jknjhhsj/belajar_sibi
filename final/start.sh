#!/bin/bash
cd /app

# Use env from Railway variables
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Set production values
sed -i 's/APP_ENV=local/APP_ENV=production/' .env
sed -i 's/APP_DEBUG=true/APP_DEBUG=false/' .env

# Generate key if not set
php artisan key:generate --force 2>/dev/null || true

# Create SQLite database if not exists
mkdir -p database
if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
fi

# Run migrations
php artisan migrate --force

# Seed if database is empty
USERCOUNT=$(php artisan tinker --execute="echo App\Models\User::count();" 2>/dev/null | tail -1)
if [ "$USERCOUNT" = "0" ] || [ -z "$USERCOUNT" ]; then
    php artisan db:seed --force 2>/dev/null || true
fi

# Clear and cache config
php artisan config:clear
php artisan cache:clear

# Start server
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
