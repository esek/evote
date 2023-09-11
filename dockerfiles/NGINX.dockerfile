FROM nginx:latest
COPY nginxconf/nginx.conf /etc/nginx/conf.d/nginx.conf
COPY nginxconf/php.conf /etc/nginx/php.conf
COPY nginxconf/fastcgi_params /etc/nginx/fastcgi_params
COPY ./app/ /app/
RUN chown -R www-data:www-data /app
