FROM php:7.4.33-fpm

RUN docker-php-ext-install pdo pdo_mysql mysqli