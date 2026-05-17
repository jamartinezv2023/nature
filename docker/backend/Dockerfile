FROM php:8.3-fpm-alpine

# Instalar extensiones necesarias para producción y bases de datos
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

EXPOSE 9000
CMD ["php-fpm"]
