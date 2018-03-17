<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

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
            $table->string('contact')->nullable();
            $table->float('balance',8)->default(0);
            $table->float('profit')->default(0);
            $table->string('image_url')->nullable()->unique();
            $table->dateTime('certification_time')->nullable();
            $table->dateTime('last_login_time');
            $table->dateTime('this_login_time');
            $table->dateTime('signup_time');
            $table->dateTime('risk_time')->nullable();
            $table->Integer('risk_score')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_address')->nullable();
            $table->string('bank_card')->nullable();
            $table->string('capital_password');
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
