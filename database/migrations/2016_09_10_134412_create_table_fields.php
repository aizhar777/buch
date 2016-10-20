<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->string('slug', 255)->nullable();
            $table->text('value');
            $table->text('default_value')->nullable()->default(NULL);
            $table->integer('accessory_id')->unsigned();
            $table->string('accessory_type', 45);
            $table->integer('param_id')->unsigned();
            $table->boolean('is_hidden')->default(0);
            $table->timestamps();

            $table->index('accessory_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fields');
    }
}
