FROM php:8.1-apache

# Install system dependencies and required PHP extensions
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt-get/lists/*

# Enable Apache URL rewriting (.htaccess support)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files into web root
COPY . /var/www/html/

# Set proper ownership and permissions for Apache web server
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose standard web server port
EXPOSE 80

# Command to launch Apache in the foreground
CMD ["apache2-foreground"]