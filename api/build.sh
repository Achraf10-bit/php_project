#!/bin/bash

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Install Node.js dependencies
npm ci
npm run build

# Copy necessary files
mkdir -p .vercel/output/static
cp -r public/* .vercel/output/static/
cp -r storage/app/public/* .vercel/output/static/storage/

# Create storage symlink
php artisan storage:link 