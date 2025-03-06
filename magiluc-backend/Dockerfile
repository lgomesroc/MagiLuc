# Use a imagem PHP com Apache
FROM php:8.1-apache

# Instale extensões e ferramentas necessárias
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql

# Instale o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configurar permissão para usar Composer como superusuário
ENV COMPOSER_ALLOW_SUPERUSER=1

# Copie os arquivos do projeto para o contêiner
COPY . /var/www/html

# Instale o Flight PHP via Composer
WORKDIR /var/www/html
RUN composer require mikecao/flight

# Permissões no diretório de trabalho
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exponha a porta 8000
EXPOSE 8000

# Comando de inicialização
CMD ["php", "-S", "0.0.0.0:8000", "-t", "/var/www/html"]
