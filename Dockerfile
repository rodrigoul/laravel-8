FROM php:8.0.5-fpm-alpine

RUN apk update && \
    apk add --no-cache \
    nginx \
    libzip-dev \
    zip \
    supervisor \
    && rm -rf /var/cache/apk/* \
    && mkdir -p /run/nginx 

RUN docker-php-ext-install pdo_mysql mysqli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apk add --update nodejs npm git

WORKDIR /var/www/html

RUN git clone -b main https://rodrigoul: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@github.com/rodrigoul/laravel-8.git

COPY .env.example /var/www/html/laravel-8/.env
COPY Dockerfile /var/www/html/laravel-8/Dockerfile

RUN cd laravel-8 && composer install && npm install

RUN rm /etc/nginx/nginx.conf
ADD ./deploy/nginx.conf /etc/nginx/nginx.conf

ADD ./deploy/sites-enabled /etc/nginx/sites-enabled

ADD ./deploy/nginx-supervisor.ini /etc/supervisor.d/nginx-supervisor.ini

RUN ln -sf /dev/stderr /var/log/nginx/error.log
RUN ln -sf /dev/stdout /var/log/nginx/access.log

RUN chown -R www-data:www-data /var/www/html && \
chmod -R 775 /var/www/html

RUN chown -R www-data:www-data /var/www/html/laravel-8/storage /var/www/html/laravel-8/bootstrap/cache /var/www/html/laravel-8/vendor
RUN chmod -R 775 /var/www/html/laravel-8/storage /var/www/html/laravel-8/bootstrap/cache /var/www/html/laravel-8/vendor

EXPOSE 8080

# Start
CMD php-fpm & nginx -g "error_log /dev/stdout info;"