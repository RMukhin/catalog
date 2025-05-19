FROM node:20-alpine

WORKDIR /var/www/src

COPY package*.json ./

RUN npm install

COPY . .

