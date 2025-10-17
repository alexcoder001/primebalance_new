# Use the official PHP 8.2 image with FPM
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql gd mbstring bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel setup
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Expose port 8000 for Render
EXPOSE 8000

# Run Laravel's built-in server
CMD php artisan serve --host=0.0.0.0 --port=8000
