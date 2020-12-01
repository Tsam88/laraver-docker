FROM php:7.4-fpm

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Install composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Add user for laravel application
RUN groupadd -g 1001 chtsiamouras
RUN useradd -u 1001 -ms /bin/bash -g chtsiamouras chtsiamouras

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=chtsiamouras:chtsiamouras . /var/www

#RUN usermod -u 1001 chtsiamouras

#RUN chmod 777 /var/www

# Change current user to www
USER chtsiamouras

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
