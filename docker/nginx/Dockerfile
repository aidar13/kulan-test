FROM nginx:latest

RUN ln -sf /dev/stdout /var/log/nginx/access.log && \
    ln -sf /dev/stderr /var/log/nginx/error.log && \
    rm -rf /etc/nginx/conf.d/*

# put nginx config
COPY ./docker/nginx/nginx.conf /etc/nginx/conf.d/default.conf
