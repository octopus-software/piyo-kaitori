FROM php:8.3-apache

# 必要な PHP 拡張機能をインストール
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Apache mod_rewrite を有効化
RUN a2enmod rewrite

# Node.js と npm のインストール (推奨: NodeSource)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm

# バージョン確認 (オプション: ビルド時の確認用)
RUN node -v && npm -v

# Composer のインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Apache の設定を変更（DocumentRoot を public ディレクトリに設定）
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# 作業ディレクトリを設定
WORKDIR /var/www/html

# プロジェクトファイルをコンテナにコピー
COPY . /var/www/html

# 適切なパーミッションを設定
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# 80 番ポートを開放
EXPOSE 80

# Apache をフォアグラウンドで実行
CMD ["apache2-foreground"]
