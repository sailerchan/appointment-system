# ---------- Base image ----------
FROM php:8.2-fpm

# ---------- System dependencies ----------
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# ---------- Composer ----------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ---------- Working directory ----------
WORKDIR /var/www

# ---------- Copy application ----------
COPY . .

# ---------- Install dependencies ----------
RUN composer install --no-dev --optimize-autoloader

# ---------- Permissions ----------
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage /var/www/bootstrap/cache

# ---------- Expose port ----------
EXPOSE 9000

# ---------- Start PHP-FPM ----------
CMD ["php-fpm"]
