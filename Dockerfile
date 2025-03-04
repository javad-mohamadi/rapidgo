FROM php:8.2-fpm

COPY composer.lock composer.json /var/www/

WORKDIR /var/www

# Install necessary system dependencies including libonig-dev for mbstring
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev \
    libwebp-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Install GD extension properly for PHP 8.2+
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create a non-root user and set permissions
RUN groupadd -g 1000 rapidgo && \
    useradd -u 1000 -ms /bin/bash -g rapidgo rapidgo

COPY . /var/www
COPY --chown=rapidgo:rapidgo . /var/www

USER rapidgo

EXPOSE 9000
CMD ["php-fpm"]
