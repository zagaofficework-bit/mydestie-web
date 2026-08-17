FROM php:8.1-apache

# Install system dependencies and PHP extensions required for image upload/processing
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql zip

# Enable Apache mod_rewrite (useful for clean URL routing and .htaccess)
RUN a2enmod rewrite

# Set working directory inside container
WORKDIR /var/www/html

# Copy application files into the container
COPY . /var/www/html/

# Adjust file permissions for uploads/cache directories
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80