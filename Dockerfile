## STAGE 1: PHP Server
ARG PHP_VERSION
FROM php:${PHP_VERSION} as server

### Diretório da aplicação
ARG APP_DIR=/var/www/app
ARG EXTERNAL_APP_DIR=./../../

### Versão da Lib do Redis para PHP
ARG REDIS_LIB_VERSION=5.3.7

### Instalação de pacotes e recursos necessários no S.O.
RUN apt-get update -y \
    && apt-get install -y --no-install-recommends \
    apt-utils \
    supervisor \
    zlib1g-dev \
    libpng-dev \
    libpq-dev \
    libxml2-dev \
    libhiredis-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Dependências do PHP
RUN docker-php-ext-install pdo pdo_pgsql pgsql session pcntl

### Arquivos de configuração
COPY --chown=www-data:www-data ./docker/supervisord/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY --chown=www-data:www-data ./docker/php/extra-php.ini "$PHP_INI_DIR/conf.d/99_extra.ini"

### Copiando aplicação para dentro do container
WORKDIR $APP_DIR
COPY --chown=www-data:www-data . .
RUN cd $APP_DIR


### Limpeza e otimização da construção
RUN rm -rf /var/lib/apt/lists/* docker Dockerfile .env \
    && apt-get autoremove -y \
    && apt-get clean

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
