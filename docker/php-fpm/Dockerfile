FROM php:7.4-fpm

RUN pecl install xdebug-2.9.1 \
    && docker-php-ext-enable xdebug

RUN docker-php-ext-install mysql && docker-php-ext-enable mysql
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

#RUN docker-php-ext-install pdo pdo_mysql \
#    && php-mysql \

#
#
#RUN apt-get update \
#  && apt-get install -y mysql-client libmysqlclient-dev --no-install-recommends \
#  && apt-get clean \
#  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

