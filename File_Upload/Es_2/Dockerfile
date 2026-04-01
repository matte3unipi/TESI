# DOCKERFILE FILE UPLOAD 2
FROM php:8.2.30-apache

# Flag come parametrico per la build
ENV FLAG="SNH{p0lygl0t_byp4ss_str_p0s_f41l3d}"

# Abilita mod_rewrite per .htaccess
RUN a2enmod rewrite

# Configura Apache per permettere .htaccess
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Copia i file dell'applicazione
COPY ./src/ .

# Crea directory upload e file flag nel path richiesto
RUN mkdir -p files/images && \
    echo $FLAG > files/images/flag.txt && \
    chown -R www-data:www-data files && \
    chmod 755 files && \
    chmod 755 files/images && \
    chmod 644 files/images/flag.txt

# Configura permessi per le sessioni PHP
RUN mkdir -p /var/lib/php/sessions && \
    chown -R www-data:www-data /var/lib/php/sessions

CMD ["apache2-foreground"]