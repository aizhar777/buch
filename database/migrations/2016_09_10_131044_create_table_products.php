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
            $table->integer('stock_id')->unsigned()->nullable();
            $table->string('stock_type')->nullable();
            $table->integer('subdivision_id')->unsigned()->nullable();
            $table->string('subdivision_type')->nullable();
            $table->timestamps();

            $table->index(['price','cost','is_service','balance']);
            $table->index('name');
            $table->index('stock_id');
            $table->index('subdivision_id');

            $table->foreign('stock_type')
                ->references('cat_type')->on('categories')
                ->onDelete('set null')
                ->onUpdate('no action');

            $table->foreign('subdivision_type')
                ->references('cat_type')->on('categories')
                ->onDelete('set null')
                ->onUpdate('no action');
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
