<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager', function (Blueprint $table) {
            $table->engine = 'InnoDB';//设置存储引擎
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password', 60);
            $table->string('image_url')->nullable()->unique();
            $table->dateTime('last_login_time')->default(Carbon::now());
            $table->dateTime('this_login_time')->default(Carbon::now());
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
        Schema::drop('manager');
    }
}
