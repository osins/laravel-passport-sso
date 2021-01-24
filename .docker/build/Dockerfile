FROM php:7.2.5-fpm-stretch

RUN /bin/cp /usr/share/zoneinfo/Asia/Shanghai /etc/localtime; \
    echo 'Asia/Shanghai' > /etc/timezone; \
    apt-get update; apt-get install -y \
    apt-utils iputils-ping \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libmemcached-dev \
    zlib1g-dev \
    libz-dev \
    libpq-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libicu-dev \
    libssl-dev \
    libmcrypt-dev \
    libonig-dev \
    libcurl3 \
    libcurl3-openssl-dev \
    locales \
    supervisor \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    zip unzip git; \
    docker-php-source extract; 
RUN docker-php-ext-install pdo_mysql; \ 
    echo "\nyes" | pecl install mcrypt; \
    docker-php-ext-enable mcrypt mbstring; \
    # install memcached
    mkdir /usr/src/php/ext/memcached; \
    curl -L https://github.com/php-memcached-dev/php-memcached/archive/v3.0.4.tar.gz | tar xvz -C /usr/src/php/ext/memcached --strip 1 ; \
    docker-php-ext-configure memcached; \
    docker-php-ext-install memcached; \
    # install redis
    mkdir /usr/src/php/ext/redis; \
    curl -L https://github.com/phpredis/phpredis/archive/3.0.0.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1; \
    docker-php-ext-configure redis; \
    docker-php-ext-install redis; \
    # install zip
    docker-php-ext-install zip; \
    # install gd
    docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/; \
    docker-php-ext-install gd; \
    # installl igbinary msgpack xdebug
    pecl install igbinary msgpack xdebug; \
    # enable igbinary msgpack xdebug memcached redis
    docker-php-ext-enable igbinary msgpack xdebug; \
    # install composer
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"; \
    php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"; \
    php composer-setup.php; \
    php -r "unlink('composer-setup.php');"; \
    mv composer.phar /usr/local/bin/composer; \
    # clear temp files
    # docker-php-source delete; \
    rm -rf /var/lib/apt/lists/*; \
    rm -rf /tmp/*; \
    apt-get clean; 

