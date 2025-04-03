FROM php:8.2-fpm

WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    wget \
    gnupg \
    curl


# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
&& docker-php-ext-install gd pdo pdo_mysql

# Set short_open_tag to Off
RUN echo "short_open_tag = Off" > /usr/local/etc/php/conf.d/custom.ini

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Symfony CLI
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash \
&& apt-get install -y symfony-cli

# Copy application files
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www

# Switch to non-root user
USER www-data

# Expose port 8080 for fastcgi
EXPOSE 80

CMD ["php-fpm", "-F"]