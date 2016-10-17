<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRequisites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('legal_name', 255);
            $table->string('bank', 255);
            $table->string('iik', 255);
            $table->string('bin', 255);
            $table->string('cbe', 255)->nullable();
            $table->integer('relation_id')->unsigned();
            $table->string('relation_type', 255)->nullable();
            $table->timestamps();

            $table->index('relation_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisites');
    }
}
