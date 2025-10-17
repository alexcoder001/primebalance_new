# Use the official PHP 8.2 FPM image
FROM php:8.2-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql gd mbstring bcmath zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

RUN php artisan config:clear && php artisan cache:clear && php artisan view:clear

# Laravel setup
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Expose port 8000 for Render
EXPOSE 8000

RUN chmod -R 775 storage bootstrap/cache

# Start Laravel server
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}

