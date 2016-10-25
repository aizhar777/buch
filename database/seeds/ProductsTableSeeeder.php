<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('ru_RU');
        $stock =  1; //\App\Stock::firstOrFail()->id;
        $subdivision = 1; //\App\Subdivision::firstOrFail()->id;

        for($i = 0; $i < 10; $i++){

            \App\Product::create([
                'name' => $faker->text(rand(6, 18)),
                'description' => $faker->text(rand(130,640)),
                'price' => $faker->randomFloat(null,5000,10000),
                'cost' => $faker->randomFloat(null,null,3000),
                'is_service' => rand(0,1),
                'balance' => rand(3,100),
                'stock_id' => $stock,
                'subdivision_id' => $subdivision,
            ]);
        }
    }
}
