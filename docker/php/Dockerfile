FROM php:8.2.7-fpm

COPY php.ini /usr/local/etc/php/

RUN apt update \
  && apt install -y \
  cron \
  default-mysql-client \
  git\
  supervisor \
  tini \
  zlib1g-dev \
  libzip-dev \
  unzip \
  libpng-dev \
  libjpeg-dev \
  libfreetype6-dev \
  && docker-php-ext-install pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

WORKDIR /var/www


# `supervisord` の設定ファイルをコピー
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# `crontab` ファイルをコピー
COPY crontab /etc/cron.d/my-cron-job

# `crontab` ファイルのパーミッションを設定
RUN chmod 0644 /etc/cron.d/my-cron-job

# `crontab` を有効にする
RUN crontab /etc/cron.d/my-cron-job

ENTRYPOINT ["/usr/bin/tini", "--"]

# `supervisord` をデフォルトのコマンドとして設定
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]