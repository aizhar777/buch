<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTradeLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_logs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id', false, true);
            $table->text('description');
            $table->dateTime('created');
        });
        $prKey = 'ALTER table trade_logs  DROP PRIMARY KEY, add PRIMARY KEY (`id`,`created`);';

        $querySql = 'ALTER TABLE trade_logs PARTITION BY RANGE (MONTH(created))
            (
                PARTITION p01 VALUES LESS THAN (02) ,
                PARTITION p02 VALUES LESS THAN (03) ,
                PARTITION p03 VALUES LESS THAN (04) ,
                PARTITION p04 VALUES LESS THAN (05) ,
                PARTITION p05 VALUES LESS THAN (06) ,
                PARTITION p06 VALUES LESS THAN (07) ,
                PARTITION p07 VALUES LESS THAN (08) ,
                PARTITION p08 VALUES LESS THAN (09) ,
                PARTITION p09 VALUES LESS THAN (10) ,
                PARTITION p10 VALUES LESS THAN (11) ,
                PARTITION p11 VALUES LESS THAN (12) ,
                PARTITION p12 VALUES LESS THAN (13) ,
                PARTITION pmaxval VALUES LESS THAN MAXVALUE
            );';

        \DB::unprepared($prKey);
        \DB::unprepared($querySql);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trade_logs');
    }
}
