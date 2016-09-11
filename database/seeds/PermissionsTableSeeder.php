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
        # Clients
        Permission::create([
            'name' => 'permission.clients.view',
            'slug' => 'view.clients',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission.client.view',
            'slug' => 'view.client',
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

        # Users
        Permission::create([
            'name' => 'permission.users.show',
            'slug' => 'view.users',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission.user.show',
            'slug' => 'view.user',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission.user.create',
            'slug' => 'create.user',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission.user.edit',
            'slug' => 'edit.user',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission.user.delete',
            'slug' => 'delete.user',
            'description' => '',
        ]);

        echo 'All the permissions added'.PHP_EOL;
    }
}
