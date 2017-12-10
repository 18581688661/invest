<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->engine = 'InnoDB';//设置存储引擎
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password', 60);
            $table->string('email',30);//测试完改回唯一
            $table->string('real_name')->nullable();
            $table->string('ID_card')->nullable()->unique();
            $table->string('mobile')->nullable()->unique();
            $table->float('balance')->default(0);
            $table->string('image_url')->nullable()->unique();
            $table->rememberToken();
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
        Schema::drop('user');
    }
}
