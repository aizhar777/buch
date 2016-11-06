<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TestTableTradeLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $faker = Faker\Factory::create();

        /*for ($i =0; $i < 1500; $i++){
            $logs = [];
            for ($j = 0;$j < 1000;$j++){
                $logs[] = [
                    'user_id' => 1,
                    'description' => $faker->text(rand(100, 300)),
                    'created' => $this->rand_date('2015-01-01 00:00:00','2016-16-06 07:00:00')
                ];
            }

            \DB::table('trade_logs')->insert($logs);
            echo $i . ' - 1000 logs inserted!' . PHP_EOL;
        }*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $sql = 'TRUNCATE TABLE `trade_logs`';
        //\DB::unprepared($sql);
    }

    public function rand_date($min_date, $max_date) {
        $min_epoch = strtotime($min_date);
        $max_epoch = strtotime($max_date);
        $rand_epoch = rand($min_epoch, $max_epoch);
        return date('Y-m-d H:i:s', $rand_epoch);
    }
}
