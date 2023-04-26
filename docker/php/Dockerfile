FROM php:8.1-fpm

# set main params
ENV APP_HOME /srv/www
ENV USERNAME=www-data

RUN apt-get update && apt-get upgrade -y && apt-get install -y \
      procps \
      nano \
      unzip \
      libicu-dev \
      zlib1g-dev \
      libxml2 \
      libxml2-dev \
      libreadline-dev \
      libzip-dev \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-configure intl \
    && docker-php-ext-install \
      pdo_mysql \
      sockets \
      intl \
      zip \
    && rm -rf /tmp/* \
    && rm -rf /var/list/apt/* \
    && rm -rf /var/lib/apt/lists/* \
    && apt-get clean

RUN deluser www-data && \
    useradd -ms /bin/sh www-data && \
    echo 'www-data    ALL=(root) NOPASSWD: /bin/sed, /bin/echo, /bin/cp, /usr/sbin/crond' >> /etc/sudoers && \
    mkdir -p /home/www-data/.composer && \
    chown -R www-data:www-data /home/www-data

# put php config for Laravel
COPY ./docker/nginx/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN chmod +x /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

# set working directory
WORKDIR $APP_HOME
USER ${USERNAME}

# copy source files and config file
COPY --chown=${USERNAME}:${USERNAME} . $APP_HOME/
COPY --chown=${USERNAME}:${USERNAME} .env.local $APP_HOME/.env

# install all PHP dependencies
RUN COMPOSER_MEMORY_LIMIT=-1 composer install --optimize-autoloader --no-interaction --no-progress;

