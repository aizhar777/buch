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

        # Requisite
        Permission::create([
            'name' => 'permission.requisites.view',
            'slug' => 'view.requisites',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'permission.requisite.view',
            'slug' => 'view.requisite',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission.requisite.create',
            'slug' => 'create.requisite',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission.requisite.edit',
            'slug' => 'edit.requisite',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission.requisite.delete',
            'slug' => 'delete.requisite',
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

        # FieldParam
        Permission::create([
            'name' => 'permission.fieldParam.show',
            'slug' => 'view.fieldParam',
            'description' => '',
        ]);
        Permission::create([
            'name' => 'permission.fieldParams.show',
            'slug' => 'view.fieldParams',
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

        # Field

        Permission::create([
            'name' => 'permission.fields.show',
            'slug' => 'view.fields',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission.field.show',
            'slug' => 'view.field',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission.field.create',
            'slug' => 'create.field',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission.field.edit',
            'slug' => 'edit.field',
            'description' => '',
        ]);

        Permission::create([
            'name' => 'permission.field.delete',
            'slug' => 'delete.field',
            'description' => '',
        ]);

        echo 'All the permissions added'.PHP_EOL;
    }
}
