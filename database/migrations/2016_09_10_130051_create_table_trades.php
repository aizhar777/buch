<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTrades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status')->unsigned();
            $table->integer('ppc')->unsigned()->nullable();
            $table->integer('curator')->unsigned()->nullable();
            $table->integer('client_id')->unsigned();
            $table->boolean('payment_is_completed')->default(0);
            $table->integer('completed_by_user')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('status')
                ->references('id')->on('trade_statuses')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('ppc')
                ->references('id')->on('ppc')
                ->onDelete('set null')
                ->onUpdate('no action');

            $table->foreign('client_id')
                ->references('id')->on('clients')
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
        Schema::dropIfExists('trades');
    }
}
