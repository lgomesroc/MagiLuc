# Use uma imagem Node.js
FROM node:18

# Defina o diretório de trabalho
WORKDIR /app

# Copie os arquivos do projeto para o contêiner
COPY package*.json ./

# Instale as dependências do projeto
RUN npm install

# Copie o restante dos arquivos do projeto
COPY . .

# Execute a aplicação
CMD ["npm", "start"]

# Exponha a porta 3000
EXPOSE 3000
