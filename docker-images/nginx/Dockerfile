FROM nginx:1.18-alpine
LABEL maintainer="Fillipe Almeida Dutra <fillipe@querycommerce.com>" \
      Description="Servidor HTTP criado para o trabalho final de Sistemas Distribuídos - UniBH / UNA." \
      Version="1.0.0"

RUN addgroup -g 1000 sjobs \
    && adduser -G sjobs -u 1000 -h /home/sjobs -s /bin/bash -S sjobs
RUN touch /var/run/nginx.pid
RUN mkdir /sock
RUN mkdir /var/www
RUN mkdir /etc/nginx/custom.d

COPY ./conf/nginx.conf /etc/nginx/
COPY ./conf/fastcgi_backend.conf /etc/nginx/conf.d/
COPY ./conf/frontapp.conf /etc/nginx/conf.d/

RUN chown -R sjobs:sjobs /etc/nginx /var/www /var/cache/nginx /var/run/nginx.pid /sock

USER sjobs:sjobs
VOLUME /var/www
WORKDIR /var/www/

EXPOSE 80