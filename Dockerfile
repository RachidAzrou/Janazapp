FROM php:8.2-apache

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Allow Composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy Laravel app files
COPY . .

# Install Laravel dependencies only (no artisan commands yet)
RUN composer install --no-dev --optimize-autoloader

# Set proper permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port 80
EXPOSE 80

# Start the app with artisan commands after env is loaded
CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    apache2-foreground
