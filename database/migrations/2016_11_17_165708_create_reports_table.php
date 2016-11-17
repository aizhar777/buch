<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users',false,true)->nullable();
            $table->integer('subdivisions',false,true)->nullable();
            $table->integer('stocks',false,true)->nullable();
            $table->integer('trades',false,true)->nullable();
            $table->integer('products',false,true)->nullable();
            $table->integer('clients',false,true)->nullable();
            $table->double('money')->nullable();
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
        Schema::dropIfExists('reports');
    }
}
