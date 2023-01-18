FROM php:8.1-fpm
USER root

RUN apt-get update && \
    apt-get install -y git zip ca-certificates git curl  g++ libzip-dev autoconf libxml2-dev




RUN docker-php-ext-install pdo pdo_mysql


