FROM php:8.2-apache

WORKDIR /var/www/html/

RUN apt-get update && apt-get install -y --force-yes \
    freetds-dev \
    libicu-dev \
    libpq-dev \
    libpng-dev \
    libzip-dev \
    git \
 && rm -r /var/lib/apt/lists/* \
 && cp -s /usr/lib/x86_64-linux-gnu/libsybdb.so /usr/lib/ \
 && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
 && docker-php-ext-install \
    gd \
    pcntl \
    pdo_dblib \
    pdo_mysql \
    pdo_pgsql \
    zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite

COPY virtualhost.conf /etc/apache2/sites-enabled/000-default.conf

RUN git clone https://github.com/willGabrielPereira/product-manager.git .

RUN chown -R www-data:www-data /var/www

RUN composer install --no-dev --prefer-dist --no-autoloader --no-scripts

RUN chmod -R 777 storage
RUN chmod -R 777 bootstrap/cache
RUN composer dump-autoload

EXPOSE 80
