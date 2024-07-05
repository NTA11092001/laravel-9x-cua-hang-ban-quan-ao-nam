# Sử dụng PHP 8.2
FROM php:8.1-fpm

RUN curl -sSL https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o - | sh -s \
    gd pdo_mysql mysqli 

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libwebp-dev

# Chỉnh sửa php extension configure
RUN docker-php-ext-configure gd --enable-gd --with-jpeg --with-webp

# Set working directory
WORKDIR /var/www/balshop.com

# Copy source code lên serve
COPY . .

# Cài đặt Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Chạy composer install
RUN composer install

RUN chmod -R 777 bootstrap/ 

RUN chmod -R 777 storage/ 

RUN php artisan storage:link

RUN php artisan optimize:clear

#Expose port 8000
EXPOSE 8000
# CMD ["php-fpm"]