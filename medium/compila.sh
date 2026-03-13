#!/bin/bash

# Ferma e rimuovi container esistente
sudo docker stop my-ctf 2>/dev/null || true
sudo docker rm my-ctf 2>/dev/null || true

# Ricostruisci l'immagine
sudo docker build -t ctf-challenge . 

# Avvia il container
sudo docker run -d -p 8080:80 --name my-ctf ctf-challenge

echo "======== Server avviato su http://localhost:8080"
echo "======== Login: admin / admin"