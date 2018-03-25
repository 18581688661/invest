<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('user_id');
            $table->Integer('invest_amount');
            $table->dateTime('invest_start_time');
            $table->dateTime('invest_stop_time')->nullable();
            $table->float('profit');
            $table->Integer('state');
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
        Schema::drop('current');
    }
}
