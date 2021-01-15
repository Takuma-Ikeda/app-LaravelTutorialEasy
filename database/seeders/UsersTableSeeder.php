<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // users テーブルを初期化
        DB::table('users')->delete();

        // users テーブルにテストデータ挿入
        DB::table('users')->insert([
            [
                'name'    => 'user1',
                'email' => 'user1@example.com',
                // パスワードは暗号化する
                'password' => Hash::make('secret'),
                // 以下はなくてもOK
                'remember_token' => Str::random(10),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
