#!/bin/bash

# export FLAG="SNH{X5S_st0r3d_AtTaCk_Det3cTeD_Tag_5cr1pt}"

# Ferma e rimuovi container esistente
sudo docker stop xss_st_2 2>/dev/null || true
sudo docker rm xss_st_2 2>/dev/null || true

# Ricostruisci l'immagine
sudo docker build -t xss_st_2_image .

# Rimuovi immagini dangling (tag <none>)
sudo docker image prune -f

# Avvia il container
sudo docker run -d -p 8080:80 --name xss_st_2 xss_st_2_image

# Con flag in ambiente
# sudo docker run -d -p 8080:80 --name xss_st_2 -e FLAG="${FLAG}" xss_st_2_image

echo "======== Server avviato su http://localhost:8080"