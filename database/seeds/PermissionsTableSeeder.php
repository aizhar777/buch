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

        # FieldParam
        Permission::create([
            'name' => 'permission.fieldParam.show',
            'slug' => 'view.fieldParam',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission.fieldParam.create',
            'slug' => 'create.fieldParam',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission.fieldParam.edit',
            'slug' => 'edit.fieldParam',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission.fieldParam.delete',
            'slug' => 'delete.fieldParam',
            'description' => '',
        ]);

        # Fields

        Permission::create([
            'name' => 'permission.fields.show',
            'slug' => 'view.fields',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission.fields.create',
            'slug' => 'create.fields',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission.fields.edit',
            'slug' => 'edit.fields',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission.fields.delete',
            'slug' => 'delete.fields',
            'description' => '',
        ]);

        echo 'All the permissions added'.PHP_EOL;
    }
}
