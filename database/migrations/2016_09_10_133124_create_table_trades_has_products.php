<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTradesHasProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades_has_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trades_id')->unsigned();
            $table->integer('products_id')->unsigned();
            $table->integer('quantity');
            $table->nullableTimestamps();

            $table->foreign('trades_id')
                ->references('id')->on('trades');

            $table->foreign('products_id')
                ->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trades_has_products');
    }
}
