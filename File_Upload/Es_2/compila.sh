#!/bin/bash

# export FLAG="SNH{p0lygl0t_byp4ss_str_p0s_f41l3d}"

# Ferma e rimuovi container esistente
sudo docker stop file_up_2 2>/dev/null || true
sudo docker rm file_up_2 2>/dev/null || true

# Ricostruisci l'immagine
sudo docker build -t file_up_2_image . 

# Rimuovi immagini dangling (tag <none>)
sudo docker image prune -f

# Avvia il container
sudo docker run -d -p 8080:80 --name file_up_2 file_up_2_image

# Con flag in ambiente
# sudo docker run -d -p 8080:80 --name file_up_2 -e FLAG="${FLAG}" file_up_2_image


echo "======== Server avviato su http://localhost:8080"