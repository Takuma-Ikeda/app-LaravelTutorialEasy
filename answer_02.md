# 認証機能の作成 ( make:auth )

## ログイン機能の作成（laravel6）

### laravel/uiをインストール

- `laravel/ui`
    - 以下の機能を提供
        - Javascript のビルド
        - CSSのプリプロセッサ設定のスキャフォールディングの生成コマンド

```sh
# workspace コンテナで以下コマンド
composer require laravel/ui
```

### artisanコマンドを実行

- Vue または React による View ファイルを作成する
    - 今回は Vue を使うことにする
- `--auth` オプション
    - 認証機能 (ログイン) の View ファイル作成

```sh
# Vueで実装する場合
＃ php artisan ui vue --auth

# Reactで実装する場合
＃ php artisan ui react --auth
```

- `resources/js/app.js`
- `resources/js/components/ExampleComponent.vue`

```sh
php artisan migrate
```

### npmパッケージをインストール

- JavaScript ライブラリを使うには `npm` もしくは `yarn` コマンドを使う
    - 今回は `npm` を使うことにする

```sh
# または npm install
npm i
```

### npmパッケージをビルド

```sh
# 開発環境
npm run dev

# 本番環境
npm run production
```

### 動作確認

- http://localhost/
    - 右上に login / register ボタンが表示される

## Auth機能にシーダーを実行＆各画面の確認（laravel6）

### シーダーファイル（スケルトン）の作成

```sh
php artisan make:seeder UsersTableSeeder
```

- シーダーの命名規則
    - アッパーキャメル
    - 指定なし
    - `UsersTableSeeder.php`
- `database/seeders/UsersTableSeeder.php`

### シーダーファイルの編集

- `database/seeders/UsersTableSeeder.php`

### DatabaseSeeder.phpの編集

- `database/seeders/DatabaseSeeder.php`

### シーダーの実行

```sh
php artisan db:seed
```

### DBテーブルの確認

http://localhost:8081/ で確認するか、MySQL コンテナからログインする

```sh
docker-compose exec mysql bash
mysql -u root -proot
use easy;
desc users;
+-------------------+---------------------+------+-----+---------+----------------+
| Field             | Type                | Null | Key | Default | Extra          |
+-------------------+---------------------+------+-----+---------+----------------+
| id                | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| name              | varchar(255)        | NO   |     | NULL    |                |
| email             | varchar(255)        | NO   | UNI | NULL    |                |
| email_verified_at | timestamp           | YES  |     | NULL    |                |
| password          | varchar(255)        | NO   |     | NULL    |                |
| remember_token    | varchar(100)        | YES  |     | NULL    |                |
| created_at        | timestamp           | YES  |     | NULL    |                |
| updated_at        | timestamp           | YES  |     | NULL    |                |
+-------------------+---------------------+------+-----+---------+----------------+

select * from users\G
*************************** 1. row ***************************
               id: 1
             name: user1
            email: user1@example.com
email_verified_at: NULL
         password: $2y$10$yzAv1UZnSGph3MKY6uggYuwrmKrJMWpCB92mkau3TRMJ.pOH4qyMa
   remember_token: VbjJZAtSeL
       created_at: 2021-01-14 07:28:16
       updated_at: 2021-01-14 07:28:16
1 row in set (0.01 sec)
```

### 各画面の確認

- ルーティングを確認する

```sh
# workspace コンテナで以下コマンド
php artisan route:list
```

今回、以下が作成された。

- ルーティング
    - http://localhost/
    - http://localhost/register
    - http://localhost/login
    - http://localhost/password/reset
    - http://localhost/home
- コントローラ
    - `app/Http/Controllers/ConfirmPasswordController.php`
    - `app/Http/Controllers/ForgotPasswordController.php`
    - `app/Http/Controllers/LoginController.php`
    - `app/Http/Controllers/RegisterController.php`
    - `app/Http/Controllers/ResetPasswordController.php`
    - `app/Http/Controllers/VerificationController.php`
    - `app/Http/Controllers/HomeController.php`
- ビュー
    - `resources/views/auth/passwords/confirm.blade.php`
    - `resources/views/auth/passwords/email.blade.php`
    - `resources/views/auth/passwords/reset.blade.php`
    - `resources/views/auth/login.blade.php`
    - `resources/views/auth/register.blade.php`
    - `resources/views/auth/verify.blade.php`
    - `resources/views/home.blade.php`
- モデル
    - `app/Models/User.php`

## Laravel6にメール設定（MailGun編）

### MailGunのアカウントを作成



#### Guzzle HTTPライブラリを入れる



### .envにMailGunを設定



### 動作確認



## ログイン認証機能の日本語化（laravel6）

### Laravelプロジェクト自体の日本語設定



### アプリの名前を日本語



### 画面上のテキストを日本語化



### その他の文言を日本語化



