# Use the official PHP image as the base image
FROM php:8.0-apache

# Copy project files to the working directory
COPY . /var/www/html/

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install MySQL client and PHP extensions
RUN apt-get update && apt-get install -y default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql mysqli

# Set the working directory
WORKDIR /var/www/html/

# Expose port 80
EXPOSE 80
