<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // students テーブルを初期化
        DB::table('students')->delete();

        // students テーブルにテストデータ挿入
        DB::table('students')->insert([
            [
                'name'       => 'テスト 太郎1',
                'email'      => 'test1@example.com',
                'tel'        => '090-9999-9991',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name'       => 'テスト 太郎2',
                'email'      => 'test2@example.com',
                'tel'        => '090-9999-9992',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name'       => 'テスト 太郎3',
                'email'      => 'test3@example.com',
                'tel'        => '090-9999-9993',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name'       => 'テスト 太郎4',
                'email'      => 'test4@example.com',
                'tel'        => '090-9999-9994',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name'       => 'テスト 太郎5',
                'email'      => 'test5@example.com',
                'tel'        => '090-9999-9995',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
