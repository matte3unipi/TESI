# !/bin/bash
cd "$(dirname "$0")"

# Script per ricostruire e rilanciare i container Docker
sudo docker-compose down --remove-orphans 

# Ricostruisce i container sfruttando la cache. Se modifichi il Dockerfile o altre dipendenze, la build sarà più veloce.
sudo docker-compose build 

# Rilancia i container in modalità detached
sudo docker-compose up -d

# Rimuove le immagini senza nome (dangling) rimaste dalla compilazione precedente
sudo docker image prune -f
