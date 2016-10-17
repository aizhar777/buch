<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $selfCat = 'App\Category';
        $cats = [
            'Subdivision' => 'App\Product\Subdivision',
            'Stock' => 'App\Product\Stock',
        ];

        foreach ($cats as $key => $val){
            $cat = Category::create([
                'name' => $key,
                'description' => $key,
                'cat_type' => $val,
            ]);
            $cat->children()->create([
                'name' => 'Base '.$key,
                'description' => 'Base '.$key,
                'cat_type' => $selfCat,
            ]);
        }
    }
}
