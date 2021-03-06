<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFieldParams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_params', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->string('slug', 45)->nullable();
            $table->text('default_value')->nullable();
            $table->text('description')->nullable();
            $table->string('accessory_type');
            $table->boolean('is_many_values')->default(0);
            $table->boolean('is_required')->default(0);
            $table->boolean('is_hidden')->default(0);
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
        Schema::dropIfExists('field_params');
    }
}
