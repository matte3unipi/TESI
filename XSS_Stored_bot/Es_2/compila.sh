#!/bin/bash
 
# Stop and remove any existing containers
sudo docker-compose down --remove-orphans 2>/dev/null || true
 
# Build and start both services
sudo docker-compose up --build -d

sudo docker image prune -f
 
echo "======== Web app:  http://localhost:8080"
echo "======== Bot logs: sudo docker-compose logs -f bot"
 