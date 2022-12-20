FROM nginx:stable-alpine

ENV NGINXUSER=php_docker
ENV NGINXGROUP=php_docker

RUN mkdir -p /var/www/html

ADD docker-compose/nginx/default.conf /etc/nginx/conf.d/default.conf

RUN sed -i "s/user www-data/user ${NGINXUSER}/g" /etc/nginx/nginx.conf

RUN adduser -g ${NGINXGROUP} -s /bin/sh -D ${NGINXUSER}