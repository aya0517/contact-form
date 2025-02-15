# contact-form

git clone git@github.com:tamachima327/laravel-template.git
```

```
yes | rm -r laravel-template/.git
```

```
git clone 新しいリポジトリのSSH
```

```
mv laravel-template/* laravel-template/.[^\.]* 新しいリポジトリの名前
```

```
rm -r laravel-template
```

```
cd 新しいリポジトリの名前
```

```
code .
```

## 環境構築手順

-   コンテナを立ち上げるため、以下を実行

```
docker compose up -d --build
```

-   env ファイルの作成をするため、以下を実行

```
cp src/.env.example src/.env
```

-   php にコンテナに入るため、以下を実行

```
docker compose exec php bash
```

-   composer パッケージをインストールするため、以下を実行

```
composer install
```

-   アプリケーションキーを作成するため、以下を実行

```
php artisan key:generate
```

-   マイグレーションを実行するため、以下を実行

```
php artisan migrate
```
