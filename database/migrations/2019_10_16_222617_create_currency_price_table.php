<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_price', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('currency');
            $table->unsignedInteger('precision');
            $table->string('counter_currency');
            $table->string('counter_precision');
            $table->unsignedInteger('price');
            $table->string('source');
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
        Schema::dropIfExists('currency_price');
    }
}
