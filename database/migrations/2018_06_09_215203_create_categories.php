<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id'); // categories.id - айди категории
            $table->string('title');// categories.title - название категории
            $table->string('alias');// categories.alias -  slug категории, можно использовать в качестве пути для ссылки на категорию
            $table->integer('parent')->nullable();// categories.parent - родительская категория (у категорий есть иерархия)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
