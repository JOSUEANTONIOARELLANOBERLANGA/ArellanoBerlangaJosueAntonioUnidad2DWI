FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli \
    && a2enmod rewrite \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN sed -i 's/80/8082/' /etc/apache2/ports.conf \
    && sed -i 's/80/8082/' /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

COPY . /var/www/html/

EXPOSE 8082
