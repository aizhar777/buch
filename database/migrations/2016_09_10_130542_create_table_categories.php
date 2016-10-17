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
            $table->integer('parent_id')->nullable()->index();
            $table->text('description')->nullable();
            $table->integer('lft')->unsigned()->nullable()->default(0)->index();
            $table->integer('rgt')->unsigned()->nullable()->default(0)->index();
            $table->integer('depth')->unsigned()->nullable()->default(0)->index();
            $table->string('cat_type')->nullable();
            $table->timestamps();

            $table->foreign('cat_type')
                ->references('class')->on('classes')
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
        Schema::dropIfExists('categories');
    }
}
