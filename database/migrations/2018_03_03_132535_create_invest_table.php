<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invest', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('user_id');
            $table->Integer('project_id');
            $table->string('project_name');
            $table->Integer('invest_amount');
            $table->dateTime('invest_start_time');
            $table->dateTime('project_stop_time');
            $table->float('profit');
            $table->Integer('invest_state');
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
        Schema::drop('invest');
    }
}
