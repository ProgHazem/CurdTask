# Use the official PHP image as the base image
FROM php:8.2-fpm

# Set custom memory limit and output buffering
RUN echo "memory_limit = 256M" > /usr/local/etc/php/conf.d/memory-limit.ini \
    && echo "output_buffering = 4096" > /usr/local/etc/php/conf.d/output-buffer.ini

# Install required packages and extensions, and Node.js
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libssl-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    libxpm-dev \
    libfreetype6 \
    libjpeg62-turbo \
    libxpm4 \
    autoconf \
    pkg-config \
    git \
    zip \
    unzip \
    default-mysql-client \
    zlib1g-dev \
    libcurl4-openssl-dev \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm \
    && docker-php-ext-install -j$(nproc) gd zip mysqli pdo pdo_mysql \
    && pecl install xdebug \
    && pecl install redis \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the application files into the container
COPY . .

COPY ./docker/php/php.ini-production /usr/local/etc/php/php.ini

# Environment variable to allow Composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

RUN mkdir -p /var/www/html/storage/framework/cache/data \
    && mkdir -p /var/www/html/storage/logs \
    && touch /var/www/html/storage/logs/laravel.log \
    && chown -R www-data:www-data /var/www/html/storage \
    && chmod -R 775 /var/www/html/storage

# Expose the port that PHP-FPM will listen on
EXPOSE 9000

# Health check to ensure PHP-FPM is running
HEALTHCHECK --interval=30s --timeout=5s --start-period=30s --retries=3 \
    CMD SCRIPT_NAME=/ping SCRIPT_FILENAME=/ping REQUEST_METHOD=GET cgi-fcgi -bind -connect 127.0.0.1:9000 || exit 1

# Start PHP-FPM
CMD ["php-fpm"]