<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id'); // id - айди товара
            $table->string('title', 100);// title - название товара
            $table->string('image');// image -  ссылка на изображение
            $table->text('description');// description - описание товара
            $table->date('first_invoice')->nullable();// first_invoice - дата первой продажи товара
            $table->string('url');// url - ссылка на товар на markethot.ru
            $table->decimal('price', 6, 2);// price - минимальная цена товара
            $table->integer('amount');// amount - количество всех вариаций
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
