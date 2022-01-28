<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inputs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger("active");
            $table->Integer("user_id");
            $table->tinyInteger("win_lose");
            $table->string("trade_currency");
            // $table->Integer("trade_num");
            $table->double("trade_num",11,2);
            $table->string("buy_sell");
            $table->dateTime("start_day");
            $table->dateTime("end_day");
            // $table->Integer("start_rate");
            $table->double("start_rate",11,2);
            // $table->Integer("end_rate");
            $table->double("end_rate",11,2);
            $table->double("profit_pips",11,2);
            $table->Integer("profit_yen")->nullable();
            $table->string("img_01")->nullable();
            $table->string("img_02")->nullable();
            $table->string("remarks_tech")->nullable();
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
        Schema::dropIfExists('inputs');
    }
}
