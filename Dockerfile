FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN a2enmod rewrite

RUN sed -i 's/80/8082/' /etc/apache2/ports.conf \
 && sed -i 's/80/8082/' /etc/apache2/sites-available/000-default.conf

RUN echo 'DirectoryIndex Index.php index.php index.html' > /etc/apache2/mods-enabled/dir.conf

WORKDIR /var/www/html

COPY ./src/ /var/www/html/

EXPOSE 8082

CMD ["apache2-foreground"]
