FROM php:8.0.2

WORKDIR /app

COPY . /app

RUN apt-get update && \
    apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-interaction

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
