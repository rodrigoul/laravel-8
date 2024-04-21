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

# Housekeeping
RUN mkdir -p /etc/nginx
RUN mkdir -p /run/nginx
RUN mkdir -p /var/run/php-fpm
RUN mkdir -p /var/log/supervisor

# Copie os arquivos da aplicação para o diretório de trabalho do contêiner
COPY . /var/www/html

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
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/vendor
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/vendor

# Start
CMD ["/usr/bin/supervisord"]


