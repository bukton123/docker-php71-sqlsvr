FROM php:7.1-apache

LABEL maintainer bukton <buk_ton2@hotmail.com>

ENV ACCEPT_EULA=Y

# Microsoft SQL Server Prerequisites
RUN apt-get update && apt-get install gnupg2 openssl git -y \
    && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/9/prod.list \
        > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get install -y --no-install-recommends \
        locales \
        apt-transport-https \
    && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen \
    && locale-gen \
    && apt-get update \
    && apt-get -y --no-install-recommends install \
        unixodbc-dev \
        msodbcsql17 \
    && a2enmod rewrite

RUN docker-php-ext-install mbstring pdo pdo_mysql \
    && pecl install sqlsrv pdo_sqlsrv xdebug \
    && docker-php-ext-enable sqlsrv pdo_sqlsrv xdebug
    

RUN apt-get -y install gcc g++ make autoconf libc-dev pkg-config \
    && apt-get -y install libgeoip-dev \
    && pecl install geoip-beta 

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer global require hirak/prestissimo --no-plugins --no-scripts

# RUN composer install --prefer-dist --no-scripts --no-dev --no-autoloader && rm -rf /root/.composer
# COPY . ./
# RUN composer dump-autoload --no-scripts --no-dev --optimize

# ionCube setup
COPY ./ioncube_loader_lin_7.1.so /usr/local/lib/php/extensions/no-debug-non-zts-20160303/
RUN echo "zend_extension = /usr/local/lib/php/extensions/no-debug-non-zts-20160303/ioncube_loader_lin_7.1.so" >> /usr/local/etc/php/php.ini \
    && echo "extension=geoip.so" >> /usr/local/etc/php/php.ini

WORKDIR /var/www/html/
