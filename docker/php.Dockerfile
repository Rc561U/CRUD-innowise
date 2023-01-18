FROM php:8.1-fpm
USER root

RUN apt-get update && \
    apt-get install -y git zip graphviz

RUN curl --silent --show-error https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

RUN docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-install exif

RUN apt-get install libcurl4-gnutls-dev

# install the xhprof extension to profile requests
RUN curl "https://pecl.php.net/get/xhprof-2.3.2.tgz" -fsL -o ./xhprof-2.3.2.tgz && \
    mkdir /var/xhprof && tar xf ./xhprof-2.3.2.tgz -C /var/xhprof && \
    cd /var/xhprof/xhprof-2.3.2/extension && \
    phpize && \
    ./configure && \
    make && \
    make install

# custom settings for xhprof
COPY ./xhprof.ini /usr/local/etc/php/conf.d/xhprof.ini

RUN docker-php-ext-enable xhprof

#folder for xhprof profiles (same as in file xhprof.ini)
RUN mkdir -m 777 /profiles

