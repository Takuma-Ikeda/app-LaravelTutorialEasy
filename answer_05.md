# API をつくってみよう

## ルーティング

- `routes/api.php`
    - API では `api.php` というファイルでルーティング定義する
    - 今回は `Route::resource` を利用した
        - だいたい必要な CRUD 系ルーティングをすべて生成してくれる
        - `Route::resource` は `web.php` でも利用可能

## コントローラ

```sh
# Route::resource に必要なメソッドが定義されたテンプレートになる
php artisan make:controller API/StudentController --resource
```

- `app/Http/Controllers/API/StudentController.php`
    - 今回は show メソッドだけ実装した

### 生成されるルーティングの確認

```sh
# ルーティング確認
 php artisan route:list
```

以下のルーティングが生成される

- GET|HEAD
	- api/student
	- student.index
	- App\Http\Controllers\StudentController@index
- POST
	- api/student
	- student.store
	- App\Http\Controllers\StudentController@store
- GET|HEAD
	- api/student/create
	- student.create
	- App\Http\Controllers\StudentController@create
- PUT|PATCH
	- api/student/{student}
	- student.update
	- App\Http\Controllers\StudentController@update
- DELETE
	- api/student/{student}
	- student.destroy
	- App\Http\Controllers\StudentController@destroy
- GET|HEAD
	- api/student/{student}
	- student.show
	- App\Http\Controllers\StudentController@show
- GET|HEAD
	- api/student/{student}/edit
	- student.edit
	- App\Http\Controllers\StudentController@edit

### ログ出力

- API 開発では View がないのでブラウザ画面上でデバッグできない
    - つまり `dd()` とか `var_dump()` が使えない
- API 開発でデバッグしたいときはロギングを行うことが多い
    - `Log::debug();` を使えば OK
    - デフォルトでは `storage/logs/laravel.log` にログ出力される
- 毎回ブラウザでログファイルを閲覧するのは大変なので、通常 `tail -f` コマンドを使う

```sh
# workspace コンテナにログイン

# ログファイルが更新されるたび、最終行あたりを出力する
tail -f storage/logs/laravel.log
```

## 動作確認

- `http://localhost/api/student/1`
    - GET アクセスで show メソッドの引数 `$id` に 1 が渡される
- ブラウザでは文字化けすることが多い

### ErrorExceptionflock() expects parameter 1 to be resource, bool given

```sh
chmod -R 777 storage
chmod -R 777 storage/logs
chmod -R 777 bootstrap/cache
```

```sh
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

- Laravel Permission 参考
	- https://www.tutsmake.com/laravel-8-how-to-set-up-file-permissions/

### Google Chrome で API 連携を確認する

1. 開発者ツール
2. Network タブ
3. Name から API を選択する
4. Headers の Request Headers がリクエスト内容
5. Preview が整形されたレスポンス内容
6. Response が整形されていないレスポンス内容

### Postman

- API 開発では Postman というツールを使った方が便利
    - https://www.postman.com/

## API の利用シーン

- フロントエンド (JavaScript) が API を呼び出して、取得した JSON データを HTML に埋め込む
- バックエンド (PHP) が API を呼び出して、サービスに必要なデータを取得することも多い
    - たくさんの API で作られたサービスを「マイクロサービス」という
