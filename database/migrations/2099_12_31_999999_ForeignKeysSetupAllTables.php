<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignKeysSetupAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('role_user', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('permission_role', function(Blueprint $table) {
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        Schema::table('log', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->foreign('curator')
                ->references('id')->on('users')
                ->onDelete('SET NULL')
                ->onUpdate('no action');
        });

        Schema::table('trades', function (Blueprint $table) {
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

        Schema::table('categories', function (Blueprint $table) {

            $table->foreign('cat_type')
                ->references('class')->on('classes')
                ->onDelete('set null')
                ->onUpdate('no action');
        });

        Schema::table('trades_has_products', function (Blueprint $table) {
            $table->foreign('trades_id')
                ->references('id')->on('trades');

            $table->foreign('products_id')
                ->references('id')->on('products');
        });

        Schema::table('requisites', function (Blueprint $table) {
            $table->foreign('relation_type')
                ->references('class')->on('classes')
                ->onDelete('set null')
                ->onUpdate('no action');
        });

        Schema::table('types', function (Blueprint $table) {
            $table->foreign('class_type')
                ->references('class')->on('classes')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('field_params', function (Blueprint $table) {
            $table->foreign('accessory_type')
                ->references('class')->on('classes')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('fields', function (Blueprint $table) {
            $table->foreign('accessory_type')
                ->references('class')->on('classes')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->foreign('param_id')
                ->references('id')->on('field_params')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('subdivisions', function (Blueprint $table) {
            $table->foreign('responsible')
                ->references('id')->on('users')
                ->onDelete('SET NULL')
                ->onUpdate('restrict');
        });

        Schema::table('stocks', function (Blueprint $table) {
            $table->foreign('responsible')
                ->references('id')->on('users')
                ->onDelete('SET NULL')
                ->onUpdate('restrict');

            $table->foreign('subdivision_id')
                ->references('id')->on('subdivisions')
                ->onDelete('SET NULL')
                ->onUpdate('restrict');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('stock_id')
                ->references('id')->on('stocks')
                ->onDelete('set null')
                ->onUpdate('no action');

            $table->foreign('subdivision_id')
                ->references('id')->on('subdivisions')
                ->onDelete('set null')
                ->onUpdate('no action');
        });

        Schema::table('images', function (Blueprint $table) {
            $table->foreign('imageable_type')
                ->references('class')->on('classes')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('image_id')
                ->references('id')->on('images')
                ->onDelete('set null')
                ->onUpdate('restrict');
        });

        Schema::table('trade_history', function (Blueprint $table) {
            $table->foreign('id_trade')
                ->references('id')->on('trades')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * $table->dropForeign(['user_id']);
     * @return void
     */
    public function down()
    {
        Schema::table('role_user', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['role_id']);
        });

        Schema::table('permission_role', function(Blueprint $table) {
            $table->dropForeign(['permission_id']);
            $table->dropForeign(['role_id']);
        });

        Schema::table('log', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['curator']);
        });

        Schema::table('trades', function (Blueprint $table) {
            $table->dropForeign(['status']);
            $table->dropForeign(['ppc']);
            $table->dropForeign(['client_id']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['cat_type']);
        });

        Schema::table('trades_has_products', function (Blueprint $table) {
            $table->dropForeign(['trades_id']);
            $table->dropForeign(['products_id']);
        });

        Schema::table('requisites', function (Blueprint $table) {
            $table->dropForeign(['relation_type']);
        });

        Schema::table('types', function (Blueprint $table) {
            $table->dropForeign(['class_type']);
        });

        Schema::table('field_params', function (Blueprint $table) {
            $table->dropForeign(['accessory_type']);
        });

        Schema::table('fields', function (Blueprint $table) {
            $table->dropForeign(['accessory_type']);
            $table->dropForeign(['param_id']);
        });

        Schema::table('subdivisions', function (Blueprint $table) {
            $table->dropForeign(['responsible']);
        });

        Schema::table('stocks', function (Blueprint $table) {
            $table->dropForeign(['responsible']);
            $table->dropForeign(['subdivision_id']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['stock_id']);
            $table->dropForeign(['subdivision_id']);
        });

        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['imageable_type']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['image_id']);
        });

        Schema::table('trade_history', function (Blueprint $table) {
            $table->dropForeign(['id_trade']);
        });


    }
}


















































