<?php

use Illuminate\Database\Seeder;

class TestDataAllTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Test data
        //$this->call(CategoryTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(ProductsTableSeeeder::class);
    }
}
