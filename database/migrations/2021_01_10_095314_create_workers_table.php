<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // workers テーブルを作成する
        Schema::create('workers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->comment('名前');
            $table->string('mail')->comment('メール');
            $table->integer('age')->comment('年齢');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workers');
    }
}
