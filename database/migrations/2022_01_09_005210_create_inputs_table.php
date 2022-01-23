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
            $table->Integer("trade_num");
            $table->string("buy_sell");
            $table->dateTime("start_day");
            $table->dateTime("end_day");
            $table->Integer("start_rate");
            $table->Integer("end_rate");
            $table->Integer("profit_pips");
            $table->Integer("profit_yen")->nullable();
            $table->string("img_01")->nullable();
            $table->string("img_02")->nullable();
            $table->string("remarks_tech")->nullable();
            $table->string("remarks_funda")->nullable();
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
