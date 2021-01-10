<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    /*
     * 変数 $fillable はホワイトリストのカラムを定義する
     * ここにあるカラムのみ create() / fill() / update() などで値を代入することが許可される
     */
    protected $fillable = ['username', 'mail', 'age'];
}
