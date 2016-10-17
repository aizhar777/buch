<?php

use Illuminate\Database\Seeder;

class StocksAndSubdivisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sub = null;
        $subDivision = \App\Subdivision::create([
            'name' => 'Base Subdivision',
            'slug' => 'base_sub',
            'description' => 'The default description of base subdivision',
        ]);

        if($subDivision instanceof \App\Subdivision)
            $sub = $subDivision;

        \App\Stock::create([
            'name' => 'Base Stock',
            'slug' => 'base_stock',
            'description' => 'The default description of base stock',
            'subdivision_id' => $sub->id,
        ]);
    }
}
