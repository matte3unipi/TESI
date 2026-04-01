#!/bin/bash

# 1. Set environment variables for the entire shell session
export FLAG="SNH{X5S_st0r3d_AtTaCk_Det3cTeD_3ncod3d_5cr1pt}"
export PORT=8080

# Stop and remove existing containers
sudo -E docker-compose down --remove-orphans 2>/dev/null || true
sudo -E docker rmi ctf-web ctf-bot -f 2>/dev/null || true
sudo docker system prune -f

# 2. Build and start in DETACHED mode (-d)
# The -E flag tells sudo to preserve the environment variables we exported
sudo -E docker-compose up --build -d

sudo docker image prune -f

echo "======== Web app:  http://localhost:$PORT"
echo "======== Bot logs: sudo docker-compose logs -f bot"

# Optional: Automatically start showing the bot logs
sudo -E docker-compose logs -f bot

# Note: If you want to stop the containers later, you can run:
# sudo docker stop ctf-web ctf-bot