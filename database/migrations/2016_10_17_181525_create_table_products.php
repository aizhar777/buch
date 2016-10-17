<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();
            $table->double('price')->nullable();
            $table->double('cost')->nullable();
            $table->boolean('is_service')->default(0);
            $table->integer('balance')->default(0);

            $table->integer('stock_id',false, true)->nullable();
            $table->integer('subdivision_id', false, true)->nullable();

            $table->timestamps();

            $table->index(['price','cost','is_service','balance']);
            $table->index('name');
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
