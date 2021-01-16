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

これを実行しないと Vue ファイルが CSS/JS ファイルとして生成されないので注意

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

```sh
# コンパイル
npm run dev
```

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

- メールサーバを自前で用意するのは大変なので、開発ではメール API サービスを利用することが多い
    - https://mailtrap.io/
    - https://www.mailgun.com/
        - Laravel で公式サポートされているのが mailgun
        - https://laravel.com/docs/8.x/mail

### MailGunのアカウントを作成

- https://www.mailgun.com/
    - ダッシュボード画面から「Sending」>「Domains」をクリック
    - 「Authorized Recipients」の「Email address」に受信するメールアドレスを入力して「Save Recipient」を押す
    - 入力したメールアドレス宛に「Would you like to receive emails from sankosc on Mailgun?」というタイトルのメールが届く
    - 「I Agree 」を押す
    - Confirm画面が表示されるので「Yes」を押す
- https://qiita.com/masuda-sankosc/items/68876ac7fa992746477d

### Guzzle HTTPライブラリを入れる

- 素の PHP でも HTTP リクエストを行うことはできるが、 Guzzle というライブラリを使うほうがシンプルにコードを書くことができる。
- mailgun の利用において Gullze は必須になっている

```sh
# workspace コンテナで以下コマンド
composer require guzzlehttp/guzzle
```

### .envにMailGunを設定

- mailgun > sending > oveerview の `API` と `SMTP` を参照すること

```
MAIL_DRIVER=mailgun
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_USERNAME=SMTPのUserNameを参照
MAIL_PASSWORD=SMTPのDefault Passwordを参照
MAIL_ENCRYPTION=tls
MAILGUN_DOMAIN=Overviewを参照
MAILGUN_SECRET=APIのAPI Keyを参照
MAIL_FROM_ADDRESS=実在するメールアドレスならなんでもよい
```

`.env` ファイルを変更したら、以下コマンドを必ず実行すること

```sh
php artisan config:cache
```

#### メール送信テスト

```sh
# テスト用のメールファイル作成
php artisan make:mail MailgunTest
```

- `app/Mail/MailgunTest.php`
- `resources/views/mails/mail.blade.php`

```sh
# tinker を使って、Laravel のプログラムを手動で実行する
php artisan tinker

# '送信先アドレス' は mailgun のダッシュボードから承認したメールアドレスに書き換えること
\Mail::to('送信先アドレス')->send(new App\Mail\MailgunTest());
```

### 動作確認

- http://localhost/password/reset
    - mailgun のダッシュボードから承認したメールアドレスであれば、パスワードリセットメールが届くようになる

## ログイン認証機能の日本語化（laravel6）

### Laravelプロジェクト自体の日本語設定

- `config/app.php`

### アプリの名前を日本語

- `.env`

### 画面上のテキストを日本語化

- `resources/lang/ja.json`

### その他の文言を日本語化

### Laravelプロジェクト自体の日本語設定



### アプリの名前を日本語



### 画面上のテキストを日本語化



### その他の文言を日本語化



