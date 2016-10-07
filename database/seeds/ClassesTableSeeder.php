<?php

use Illuminate\Database\Seeder;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            'App\Category' => 'Category',
            'App\Client' => 'Client',
            'App\Field' => 'Field',
            'App\FieldParam' => 'FieldParam',
            'App\Log' => 'Log',
            'App\Product' => 'Product',
            'App\Requisite' => 'Requisite',
            'App\Setting' => 'Setting',
            'App\Trade' => 'Trade',
            'App\TradeStatus' => 'TradeStatus',
            'App\Type' => 'Type',
            'App\User' => 'User',
        ];

        foreach ($array as $key => $val){
            \App\Classes::create([
                'class' => $key,
                'name' => $val
            ]);
        }
    }
}
