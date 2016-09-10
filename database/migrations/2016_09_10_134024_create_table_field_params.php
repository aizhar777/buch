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
            $table->timestamps();

            $table->foreign('accessory_type')
                ->references('class')->on('classes')
                ->onDelete('cascade')
                ->onUpdate('restrict');
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
