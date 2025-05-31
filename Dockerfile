# pake PHP resmi, versi 8.2 (sesuai Laravel versi terbaru)
FROM php:8.2-fpm

# Install dependencies PHP yang dibutuhin Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpng-dev libonig-dev libxml2-dev libpq-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# Install composer global
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy source code
COPY . .

# Install composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permission (optional, sesuaikan user)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
