<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_info', function (Blueprint $table) {
            $table->increments('id');
            $table->float('total_investment')->default(0);
            $table->float('user_profit')->default(0);
            $table->float('current_amount')->default(0);
            $table->float('current_profit')->default(0);
            $table->float('year_profit')->default(4.2);
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
        Schema::drop('website_info');
    }
}
