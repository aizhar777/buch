<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->integer('left_key')->unsigned()->default(0);
            $table->integer('right_key')->unsigned()->default(0);
            $table->integer('level')->unsigned()->default(0);
            $table->string('cat_type')->nullable();
            $table->timestamps();

            $table->foreign('cat_type')
                ->references('class')->on('classes')
                ->onDelete('set null')
                ->onUpdate('no action');

            $table->index([
                'left_key',
                'right_key',
                'level'
            ],'left_key');
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
