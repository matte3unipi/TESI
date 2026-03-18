FROM php:8.2-apache

ENV FLAG="SNH{the_B3ANS_were_not_much_g00d_4nywaY}"

RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /var/www/html

COPY app/index.php /var/www/html/
COPY app/save.php /var/www/html/
COPY app/view.php /var/www/html/
COPY app/trigger.php /var/www/html/
COPY db/db.php /var/www/html/db.php

RUN mkdir -p /var/lib/php/sessions \
 && mkdir -p /var/www/html/data \
 && chown -R www-data:www-data /var/lib/php/sessions /var/www/html

CMD ["apache2-foreground"]