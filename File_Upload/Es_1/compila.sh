#!/bin/bash

# export FLAG="SNH{unr3str1ct3d_upl04d_n0_v4lid4ti0n}"

# Ferma e rimuovi container esistente
sudo docker stop file_up_1 2>/dev/null || true
sudo docker rm file_up_1 2>/dev/null || true

# Ricostruisci l'immagine
sudo docker build -t file_up_1_image .

# Rimuovi immagini dangling (tag <none>)
sudo docker image prune -f

# Avvia il container
sudo docker run -d -p 8080:80 --name file_up_1 file_up_1_image

# Con flag in ambiente
# sudo docker run -d -p 8080:80 --name file_up_1 -e FLAG="${FLAG}" file_up_1_image


echo "======== Server avviato su http://localhost:8080"