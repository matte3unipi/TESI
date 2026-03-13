# DOCKERFILE VERSION MEDIUM
FROM php:8.2-apache

# Flag come parametrico per la build
ENV FLAG="SNH{the_B3ANS_were_not_much_g00d_4nywaY}"

# Abilita mod_rewrite per .htaccess
RUN a2enmod rewrite

# Configura Apache per permettere .htaccess
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Copia i file dell'applicazione
COPY ./src/ /var/www/html/

# Crea directory upload e file flag nel path richiesto
RUN mkdir -p /var/www/html/files/images && \
    echo $FLAG > /var/www/html/files/images/flag.txt && \
    chown -R www-data:www-data /var/www/html/files && \
    chmod 755 /var/www/html/files && \
    chmod 755 /var/www/html/files/images && \
    chmod 644 /var/www/html/files/images/flag.txt

# Configura permessi per le sessioni PHP
RUN mkdir -p /var/lib/php/sessions && \
    chown -R www-data:www-data /var/lib/php/sessions

CMD ["apache2-foreground"]