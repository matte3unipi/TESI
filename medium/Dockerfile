# DOCKERFILE VERSION MEDIUM
FROM php:8.2-apache

# Abilita mod_rewrite per .htaccess
RUN a2enmod rewrite

# Configura Apache per permettere .htaccess
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Copia i file dell'applicazione
COPY ./src/ /var/www/html/

# Crea la directory per il file segreto (flag)
RUN mkdir -p /home/bob && \
    echo "MASTER_KEY:5B6Y84SB1SEYEKF2680463SGB" > /home/bob/secret && \
    chmod 644 /home/bob/secret

# Crea le directory per i file uploadati
RUN mkdir -p /var/www/html/files/images && \
    chown -R www-data:www-data /var/www/html/files && \
    chmod 755 /var/www/html/files && \
    chmod 755 /var/www/html/files/images

# Configura permessi per le sessioni PHP
RUN mkdir -p /var/lib/php/sessions && \
    chown -R www-data:www-data /var/lib/php/sessions

EXPOSE 80

CMD ["apache2-foreground"]