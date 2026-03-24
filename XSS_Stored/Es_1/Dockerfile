# DOCKERFILE VERSION XSS STORED BASE
FROM php:8.2-apache

# Installa Python3 e BeautifulSoup per check_attack.py
RUN apt-get update && \
    apt-get install -y python3 python3-pip && \
    pip install beautifulsoup4 --break-system-packages && \
    rm -rf /var/lib/apt/lists/*

# Flag come parametrico per la build
ENV FLAG="SHN{X5S_st0r3d_AtTaCk_Det3cTeD_Tag_5cr1pt}"

# Copia i file dell'applicazione
COPY index.php /var/www/html/
COPY view.php /var/www/html/
COPY check_attack.py /var/www/html/

# Configura permessi per il file dei commenti e per l'applicazione
RUN touch /var/www/html/comments.txt && \
    chown www-data:www-data /var/www/html/comments.txt && \
    chmod 666 /var/www/html/comments.txt && \
    chown -R www-data:www-data /var/www/html/ && \
    chmod 775 /var/www/html/ && \
    chmod +x /var/www/html/check_attack.py
    
# Configura permessi per le sessioni PHP
RUN mkdir -p /var/lib/php/sessions && \
    chown -R www-data:www-data /var/lib/php/sessions

CMD ["apache2-foreground"]
