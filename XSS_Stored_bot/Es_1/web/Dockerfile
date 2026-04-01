# DOCKERFILE VERSION XSS STORED 1
FROM php:8.2.30-apache

# Installa Python3 e BeautifulSoup per check_attack.py
RUN apt-get update && \
    apt-get install -y python3 python3-pip && \
    pip install beautifulsoup4==4.14.3 --break-system-packages && \
    pip install requests==2.33.1 --break-system-packages && \
    rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Copia i file dell'applicazione
COPY index.php .
COPY view.php .
COPY check_attack.py .

# Crea file comments.txt vuoto con permessi corretti
RUN touch comments.txt && \
    chown www-data:www-data comments.txt && \
    chmod 666 comments.txt && \
    chown -R www-data:www-data . && \
    chmod 775 . && \
    chmod +x check_attack.py

# Configura permessi per le sessioni PHP
RUN mkdir -p /var/lib/php/sessions && \
    chown -R www-data:www-data /var/lib/php/sessions

CMD ["apache2-foreground"]
