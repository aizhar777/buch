<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Build
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PPCTableSeeder::class);
        $this->call(ClassesTableSeeder::class);
        $this->call(StocksAndSubdivisionsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(FieldsTableSeeder::class);

        //Test Data
        $this->call(TestDataAllTablesSeeder::class);
    }
}
