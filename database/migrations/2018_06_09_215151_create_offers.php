<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id'); // offers.id - айди вариации
            $table->decimal('price', 6, 2);// offers.price - цена вариации
            $table->integer('amount');// offers.amount - количество вариации товара на складе
            $table->integer('sales')->nullable();// offers.sales  - единиц продано
            $table->string('article')->nullable();// offers.article - артикул вариации
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
