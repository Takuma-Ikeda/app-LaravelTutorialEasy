# CRUDアプリの作成（ver5）

## 一覧表示の作成

### テーブルやデータの準備

```sh
docker-compose exec workspace bash
# マイグレートファイルの作成
php artisan make:migration create_students_table --create=students
```

- `database/migrations/2021_01_14_093533_create_students_table.php`

```sh
# マイグレートファイルの実行
php artisan migrate

# モデルファイルの作成
php artisan make:model Student

# シーダーファイルの作成
php artisan make:seeder StudentsTableSeeder
```

- `app/Models/Student.php`
- `database/seeders/StudentsTableSeeder.php`
- `database/seeders/DatabaseSeeder.php`

```sh
php artisan db:seed
```

### ルーティングの設定

- `routes/web.php`

### コントローラーの作成

```sh
php artisan make:controller StudentController
```

- `app/Http/Controllers/StudentController.php`

### ビューの作成

- `resources/views/student/list.blade.php`

### 動作確認

- http://localhost/student/list

## 新規登録の作成

### ルーティング設定

- GET / POST 以外のリクエストメソッドについて
    - PUP / PATCH / DELETE
        - https://qiita.com/kambe0331/items/ff49b175ea9d8edec8c9
- `routes/web.php`

### コントローラーの作成

#### 入力

- `app/Http/Controllers/StudentController.php`

#### 確認（バリデーション）

```sh
php artisan make:request StudentRequest
```

- `app/Http/Requests/StudentRequest.php`
- `app/Http/Controllers/StudentController.php`

#### 完了（インサート）

- `app/Http/Controllers/StudentController.php`

### ビューの作成

#### 入力

- `resources/views/student/new_index.blade.php`

#### 確認

- `resources/views/student/new_confirm.blade.php`

#### 完了

- ビューなし

### 動作確認

- http://localhost/student/list

## 編集画面の作成

### ルーティング

- `routes/web.php`

### コントローラー

- `app/Http/Controllers/StudentController.php`

### ビュー

#### 編集画面

- `resources/views/student/edit_index.blade.php`

#### 確認画面

- `resources/views/student/edit_confirm.blade.php`

### 動作確認

- http://localhost/student/list

## 削除処理の作成

### ルーティング

- `routes/web.php`

### コントローラー

- `app/Http/Controllers/StudentController.php`

### ビュー

- `resources/views/student/list.blade.php`

### 動作確認

- http://localhost/student/list

## 検索機能の作成

### 検索フォームの追加（ビュー）

- `routes/web.php`

### ページネーションの改修（ビュー）

- `resources/views/student/list.blade.php`

### 検索機能の追加（コントローラー）

- `app/Http/Controllers/StudentController.php`

### 動作確認

- http://localhost/student/list

## フラッシュメッセージの作成

### コントローラー

- `app/Http/Controllers/StudentController.php`

### ビュー

- `resources/views/student/list.blade.php`

### 動作確認

- http://localhost/student/list
