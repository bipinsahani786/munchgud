# ==========================================
# STAGE 1: Compile Frontend Assets with Node
# ==========================================
FROM node:20-alpine AS node-builder
WORKDIR /app

# Copy packaging details and config files
COPY package*.json tailwind.config.js vite.config.js postcss.config.js ./

# Install dependencies and build assets
RUN npm ci --ignore-scripts
COPY resources ./resources
COPY public ./public
RUN npm run build

# ==========================================
# STAGE 2: Build the Core PHP-FPM Application
# ==========================================
FROM php:8.4-fpm-bullseye

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libwebp-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    ca-certificates \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mbstring \
    zip \
    exif \
    pcntl \
    bcmath \
    gd \
    opcache

# Set custom PHP settings for file uploads
RUN echo "upload_max_filesize=64M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size=64M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit=256M" >> /usr/local/etc/php/conf.d/uploads.ini

# Copy Composer binary from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files (except items in .dockerignore/.gitignore)
COPY . /var/www

# Copy compiled assets from node-builder stage
COPY --from=node-builder /app/public/build /var/www/public/build

# Install production PHP dependencies
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Set permissions for web server user
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Expose PHP-FPM default port
EXPOSE 9000

# Set entrypoint and script execution permissions
RUN chmod +x /var/www/docker/entrypoint.sh \
    && chmod +x /var/www/docker/cron.sh

ENTRYPOINT ["/var/www/docker/entrypoint.sh"]
CMD ["php-fpm"]
