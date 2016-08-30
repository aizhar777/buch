<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'permission.client.show',
            'slug' => 'show.client',
            'description' => '',
        ]);
        
        Permission::create([
            'name' => 'permission.client.create',
            'slug' => 'create.client',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission.client.edit',
            'slug' => 'edit.client',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission.client.delete',
            'slug' => 'delete.client',
            'description' => '',
        ]);

        echo 'All the permissions added'.PHP_EOL;
    }
}
