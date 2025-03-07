# Usar uma imagem base do Node.js
FROM node:20

# Definir o diretório de trabalho
WORKDIR /app

# Limpar o cache do npm
RUN npm cache clean --force

# Copiar o package.json e package-lock.json
COPY package.json ./

# Instalar as dependências
RUN npm install

# Copiar o restante do código
COPY . .

# Expor a porta 3000
EXPOSE 3000

# Comando para iniciar a aplicação
CMD ["npm", "start"]