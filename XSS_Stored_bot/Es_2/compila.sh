#!/bin/bash

# 1. Set environment variables for the entire shell session
export FLAG="SNH{X5S_st0r3d_AtTaCk_Det3cTeD_3ncod3d_5cr1pt}"
export PORT=8080

# Bring down existing containers first (fixes ContainerConfig bug)
sudo -E docker-compose down --remove-orphans 2>/dev/null || true
sudo -E docker rmi xss_2 _bot_web xss_2_bot_bot -f 2>/dev/null || true
sudo docker system prune -f

# Build and start
sudo -E docker-compose -p xss_2_bot up --build -d

sudo docker image prune -f

echo "======== Web app:  http://localhost:$PORT"

# Optional: Automatically start showing the bot logs
# sudo -E docker-compose -p xss_2_bot logs -f bot

# Note: If you want to stop the containers later, you can run:
# sudo -E docker-compose -p xss_2_bot down