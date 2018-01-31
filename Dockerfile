FROM jaschweder/php

RUN apt-get update -y \
    && apt-get upgrade -y

RUN apt-get install \
    ca-certificates \
    wget \
    unzip \
    git \
    mercurial \
    zip \
    make \
    autoconf \
    ssh \
    build-essential \
    libxml2-dev \
    libbz2-dev \
    libmcrypt-dev \
    libpq-dev \
    libcurl4-openssl-dev \
    libedit-dev \
    libreadline-dev \
    libxslt-dev \
    libpng12-dev \
    libjpeg-dev \
    pkg-config \
    iputils-ping \
    bison \
    --no-install-recommends \
    --no-install-suggests \
    -y

RUN rm -rf /usr/src/php \
    && git clone -b PHP-7.0 --depth 1 git://github.com/php/php-src /usr/src/php

WORKDIR /usr/src/php

RUN ./buildconf

RUN ./configure \
    --disable-cgi \
    --disable-short-tags \
    --enable-bcmath \
    --enable-mbstring \
    --enable-pcntl \
    --enable-maintainer-zts \
    --enable-fpm \
    --enable-soap \
    --enable-libxml \
    --with-zlib \
    --with-xsl \
    --with-zlib \
    --with-bz2 \
    --with-openssl \
    --with-mcrypt \
    --with-mysqli \
    --with-pdo-mysql \
    --with-pgsql \
    --with-pdo-pgsql \
    --with-readline \
    --with-curl \
    --with-libzip \
    --with-gd \
    --with-jpeg-dir

RUN make -j$(($(nproc)+1)) \
    && make install

RUN rm -rf /var/lib/apt/lists/* /usr/src/* \
    && apt-get autoremove \
    && apt-get autoclean
