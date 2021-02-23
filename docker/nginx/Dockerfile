FROM ubuntu:20.04
RUN apt update
RUN apt install -y \
   nginx \
   nano

RUN chown -Rf www-data:www-data /var/lib/nginx
COPY nginx.conf /etc/nginx/nginx.conf
COPY app.conf /etc/nginx/sites-enabled
RUN rm /etc/nginx/sites-enabled/default

ENV TZ=Europe/Warsaw
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

WORKDIR /var/www/app

EXPOSE 80
EXPOSE 443

CMD ["nginx"]