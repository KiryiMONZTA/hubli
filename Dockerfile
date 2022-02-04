FROM php:7.4-apache

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update -y \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
    unzip \
    && apt-get clean \
    && apt-get autoremove -y \
    && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN composer create-project oxid-support/hubli /var/www/html \
    && chown -R www-data:www-data *
