FROM php:8.2-fpm


RUN useradd -m user -u 1000 -s /bin/bash


RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd curl xml \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/src

COPY --from=composer /usr/bin/composer /usr/bin/composer

EXPOSE 9000