# 基本機能の使い方

- 命名規則について
    - https://laraweb.net/knowledge/942/
    - https://qiita.com/gone0021/items/e248c8b0ed3a9e6dbdee

---

## 入力フォームからDBに挿入の流れ

### フォーム（入力画面から確認画面）の作成

#### ビューの雛形の作成

- ビューの命名規則
    - スネークケース
    - 指定なし
    - `master_insert.blade.php`
- `resources/views/layouts/master_insert.blade.php`

#### 入力フォームの作成

- `resources/views/insert/index.blade.php`

#### 確認画面の作成

- `resources/views/insert/confirm.blade.php`

#### リクエストフォームの作成

```sh
docker-compose exec workspace bash

# InsertDemoRequest.php を作成する
php artisan make:request InsertDemoRequest
```

- `app/Http/Requests/InsertDemoRequest.php`

#### コントローラの作成

- コントローラの命名規則
    - アッパーキャメル
    - 指定なし
    - `InsertDemoController`

```sh
docker-compose exec workspace bash

# InsertDemoController.php を作成する
php artisan make:controller InsertDemoController
```

- `app/Http/Controllers/InsertDemoController.php`

#### ルーティング

- `routes/web.php`

#### 動作確認

- 入力画面が表示できれば OK
    - バリデーション・メッセージが表示されるかどうか確認
- 確認画面は `insert.finish` 作成後じゃないと確認できない

### DBのテーブル作成

#### マイグレーションファイルの作成

- マイグレーションファイルの命名規則
    - スネークケース
    - 単数形
    - `2021_01_10_095314_create_workers_table.php`

```sh
docker-compose exec workspace bash

# database/migrations/現在日時_create_workers_table.php を作成する
# --create=workers オプションを付けたので worker テーブルを CREATE する雛形ファイルになっている
php artisan make:migration create_workers_table --create=workers
```

#### マイグレーションファイルの編集

- テーブルの命名規則
    - スネークケース
    - 複数形
    - `workers`
- `database/migrations/2021_01_10_095314_create_workers_table.php`

#### マイグレーション実行

```sh
# マイグレーション実行
php artisan migrate

Migrating: 2021_01_10_095314_create_workers_table
Migrated:  2021_01_10_095314_create_workers_table (36.06ms)

# 過去に実行したマイグレーションファイルの状態がわかる
php artisan migrate:status

+------+------------------------------------------------+-------+
| Ran? | Migration                                      | Batch |
+------+------------------------------------------------+-------+
| Yes  | 2014_10_12_000000_create_users_table           | 1     |
| Yes  | 2014_10_12_100000_create_password_resets_table | 1     |
| Yes  | 2019_08_19_000000_create_failed_jobs_table     | 1     |
| Yes  | 2021_01_10_095314_create_workers_table         | 2     |
+------+------------------------------------------------+-------+
```

- マイグレーションはマイグレートファイル名の昇順で実行される
    - たまにテーブル依存関係のエラーが発生することがある
    - その場合、マイグレーションファイルをリネームして実行順を考慮する必要がある
- 実行されたマイグレーションファイル名は DB で内部的に管理されている
    - つまり、既に実行されたマイグレーションファイルは二度と実行されない
- 実行されたマイグレーションファイルを編集しても仕方がないので、マイグレーションファイルは毎回新しく作成するのがベター

#### 動作確認

http://localhost:8081/ で確認するか、MySQL コンテナからログインする

```sh
docker-compose exec mysql bash
mysql -u root -proot
use easy;
desc workers;

+------------+------------------+------+-----+---------+----------------+
| Field      | Type             | Null | Key | Default | Extra          |
+------------+------------------+------+-----+---------+----------------+
| id         | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| username   | varchar(255)     | NO   |     | NULL    |                |
| mail       | varchar(255)     | NO   |     | NULL    |                |
| age        | int(11)          | NO   |     | NULL    |                |
| created_at | timestamp        | YES  |     | NULL    |                |
| updated_at | timestamp        | YES  |     | NULL    |                |
+------------+------------------+------+-----+---------+----------------+
```

### DBの操作について（挿入）

#### 確認画面の修正

- `resources/views/insert/confirm.blade.php`

#### モデルの作成

- モデルの命名規則
    - アッパーキャメル
    - 単数形
    - `Worker`

```sh
docker-compose exec workspace bash
# Worker.php
php artisan make:model Worker
```

- `app/Models/Worker.php`

#### コントローラの編集

- `app/Http/Controllers/InsertDemoController.php`

#### ビューの作成

- `resources/views/insert/finish.blade.php`

#### ルーティング

- `routes/web.php`

#### 動作確認

http://localhost:8081/ で確認するか、MySQL コンテナからログインする

```sh
docker-compose exec mysql bash
mysql -u root -proot
use easy;
select * from workers\G

*************************** 1. row ***************************
        id: 1
  username: ????
      mail: eeeeg.takuma.ikeda@gmail.com
       age: 34
created_at: 2021-01-10 10:52:33
updated_at: 2021-01-10 10:52:33
```

### DBの操作について（一覧表示＆ページネーション）

#### コントローラ修正

- `app/Http/Controllers/InsertDemoController.php`

#### ビュー修正

- `resources/views/insert/index.blade.php`
- `app/Providers/AppServiceProvider.php`
    - Laravel 8 ではページネーションの SVG 矢印アイコンがデカすぎるバグが発生している
    - ページネーションで Bootstarap のスタイルを適用するように修正

---

## 入力フォームからメール送信の流れ

TBD

### Laravel6でメール送信（ログ出力）



#### ルーティング



#### コントローラの作成



#### ビューの作成



#### メールクラスの作成



#### メール本文の作成



#### ログファイルの設定



### Laravel6でメール送信簡易テスト(Tinker)

#### .envファイルの設定



#### 設定ファイルのキャッシュを作成



#### Tinkerでテスト送信



### Laravel6でメール送信（さくらレンタルサーバ）

#### Bootstrapのバリデーションデザインを実装



#### フォームリクエスト設定



#### Git Hubにプッシュ



#### レンタルサーバーからプル



#### 動作確認

---

## 入力フォームから画像アップロードの流れ

TBD

### 画像アップロード（基本）

#### file_existsメソッド（PHP）



#### uniqidメソッド（PHP）



#### mkdir（PHP）



#### HTTPリクエストのfileメソッド（Laravel）


### 画像アップロード（拡張）

#### バリデーションの設定



#### 画像の保存先のパスをConfigに設定



#### 画像形式を判定する関数を作成



#### コントローラの編集



#### 動作確認


