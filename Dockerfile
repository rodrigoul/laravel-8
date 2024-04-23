# Use a imagem oficial do PHP com NGINX para Laravel
FROM php:8.0.5-fpm-alpine

# Install Nginx and PHP modules
RUN apk update && \
    apk add --no-cache \
    nginx \
    libzip-dev \
    zip \
    supervisor \
    && rm -rf /var/cache/apk/* \
    && mkdir -p /run/nginx 

# Instale as extensões PHP necessárias, incluindo a extensão PDO MySQL
RUN docker-php-ext-install pdo_mysql mysqli

# Install Composer, Node.js, npm, and Git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apk add --update nodejs npm git

# Defina o diretório de trabalho para /var/www/html
WORKDIR /var/www/html

# Clone repository using HTTPS with username and access token
RUN git clone -b main https://rodrigoul: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@github.com/rodrigoul/laravel-8.git

# Copy .env.example do host para o contexto de construção da imagem
COPY .env.example /var/www/html/laravel-8/.env
COPY Dockerfile /var/www/html/laravel-8/Dockerfile

# Instalar dependências usando o Composer e npm
RUN cd laravel-8 && composer install && npm install

# Copy base Nginx config
RUN rm /etc/nginx/nginx.conf
ADD ./deploy/nginx.conf /etc/nginx/nginx.conf

# Copy base Nginx sites-enabled
ADD ./deploy/sites-enabled /etc/nginx/sites-enabled

# Add Nginx and PHP-FPM supervisor
ADD ./deploy/nginx-supervisor.ini /etc/supervisor.d/nginx-supervisor.ini

# Send logs to stdout
RUN ln -sf /dev/stderr /var/log/nginx/error.log
RUN ln -sf /dev/stdout /var/log/nginx/access.log

RUN chown -R www-data:www-data /var/www/html && \
chmod -R 777 /var/www/html

# Ajuste as permissões dos arquivos da aplicação
RUN chown -R www-data:www-data /var/www/html/laravel-8/storage /var/www/html/laravel-8/bootstrap/cache /var/www/html/laravel-8/vendor
RUN chmod -R 777 /var/www/html/laravel-8/storage /var/www/html/laravel-8/bootstrap/cache /var/www/html/laravel-8/vendor

EXPOSE 8080

# Start
CMD php-fpm & nginx -g "error_log /dev/stdout info;"
