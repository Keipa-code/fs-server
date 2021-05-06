FROM nginx:1.19-alpine

RUN apk add --no-cache curl

COPY ./docker/production/nginx/conf.d /etc/nginx/conf.d

WORKDIR /var/www

COPY ./public ./public