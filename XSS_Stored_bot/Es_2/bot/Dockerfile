FROM node:20.20.2-slim

# Installa Chromium e le dipendenze necessarie per eseguirlo in modalità headless
RUN apt-get update && apt-get install -y \
    chromium=146.0.7680.164-1~deb12u1 \
    fonts-liberation=1:1.07.4-11 \
    libatk-bridge2.0-0=2.46.0-5 \
    libatk1.0-0=2.46.0-5 \
    libcups2=2.4.2-3+deb12u9 \
    libdrm2=2.4.114-1+b1 \
    libgbm1=22.3.6-1+deb12u1 \
    libgtk-3-0=3.24.38-2~deb12u3 \
    libnspr4=2:4.35-1 \
    libnss3=2:3.87.1-1+deb12u2 \
    libxcomposite1=1:0.4.5-1 \
    libxdamage1=1:1.1.6-1 \
    libxfixes3=1:6.0.0-2 \
    libxkbcommon0=1.5.0-1 \
    libxrandr2=2:1.5.2-2+b1 \
    xdg-utils=1.1.3-4.1 \
    --no-install-recommends && \
    rm -rf /var/lib/apt/lists/*

WORKDIR /app

# Installa puppeteer core
RUN npm init -y && \
    npm install puppeteer-core@24.4.0

COPY bot.js .

CMD ["node", "bot.js"]