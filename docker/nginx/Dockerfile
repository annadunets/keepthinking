FROM nginx:1.21-alpine

COPY ./default.conf /etc/nginx/conf.d/default.conf
RUN echo "upstream php-upstream { server app:9000; }" > /etc/nginx/conf.d/upstream.conf

EXPOSE 80
EXPOSE 443
