<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->engine = 'InnoDB';//设置存储引擎
            $table->increments('id');
            $table->string('project_name');
            $table->float('rate');
            $table->Integer('project_time');
            $table->Integer('project_amount');
            $table->string('project_intro');
            $table->Integer('project_state');
            $table->Integer('amount_invested');
            $table->Integer('amount_wait');
            $table->dateTime('project_start_time');
            $table->dateTime('project_stop_time');
            $table->Integer('invest_user_amount');
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
        Schema::drop('project');
    }
}
