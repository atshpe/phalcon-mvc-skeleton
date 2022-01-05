FROM php:7.4.26-fpm

USER root

RUN apt update && apt upgrade -y
RUN apt install -y \
    make \
    libpcre3-dev \
    vim

RUN pecl channel-update pecl.php.net
RUN pecl install psr phalcon
RUN docker-php-ext-enable psr phalcon

EXPOSE 9000
