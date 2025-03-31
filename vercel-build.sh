#!/bin/bash

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Install Node.js dependencies
npm ci

# Build frontend assets
npm run build

# Create storage link
php artisan storage:link

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache 