## フレームワーク

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## 作業開始時の手順
 
```bash
docker-compose exec laravel.test composer install
docker-compose exec laravel.test npm install
docker-compose exec laravel.test php artisan migrate
docker-compose exec laravel.test npm run dev
```


## 環境構築

### 1. リポジトリのクローン

```bash
git clone https://github.com/taigabox224/piyo-kaitori.git
```

### 2. Dockerの起動

```bash
cd piyo-kaitori
docker-compose up -d
```

### 3. Laravelのインストール

```bash
docker-compose exec laravel.test composer install
```

### 4. Node.jsのインストール

```bash
docker-compose exec laravel.test npm install
```

### 5. .envファイルの作成

```bash
cp .env.example .env

```

### 6. アプリケーションキーの生成

```bash
docker-compose exec laravel.test php artisan key:generate
```

### 7. マイグレーションの実行

```bash
docker-compose exec laravel.test php artisan migrate
```

### 8. シーディングの実行

```bash
docker-compose exec laravel.test php artisan db:seed
```

### 9. アプリケーションの起動

```bash
docker-compose exec laravel.test npm run dev
```
