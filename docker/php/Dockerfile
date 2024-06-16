FROM php:8.2.12-fpm

COPY php.ini /usr/local/etc/php/

RUN apt update \
  && apt install -y default-mysql-client \
  cron \
  systemd \
  zlib1g-dev \
  libzip-dev \
  unzip \
  supervisor \
  && docker-php-ext-install pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

WORKDIR /var/www
# Supervisordの設定をコピー
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# 起動スクリプトをコピー
COPY start.sh /start.sh
RUN chmod +x /start.sh

# エントリーポイントを設定
ENTRYPOINT ["/start.sh"]