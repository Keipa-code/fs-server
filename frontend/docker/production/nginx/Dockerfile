FROM node:15-alpine as builder

WORKDIR /var/www

COPY ./package.json ./yarn.lock ./
RUN yarn install && yarn cache clean

COPY ./ ./
RUN yarn build

FROM nginx:1.19-alpine

COPY ./docker/production/nginx/conf.d /etc/nginx/conf.d

WORKDIR /var/www

COPY --from=builder /var/www/build ./public