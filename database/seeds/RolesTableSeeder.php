<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create([
            'name' => 'Administrator',
            'slug' => 'admin',
            'description' => 'Administrator of the system',
            'special' => 'all-access', //all-access or no-access
        ]);

        $permissions = \App\Permission::all();
        foreach ($permissions as $perm){
            $adminRole->assignPermission($perm->id);
            $adminRole->save();
        }

        Role::create([
            'name' => 'Accountant',
            'slug' => 'accountant',
            'description' => 'Accountant of the system',
            //'special' => null, //all-access or no-access
        ]);

        Role::create([
            'name' => 'Manager',
            'slug' => 'manager',
            'description' => 'Manager of the system',
            //'special' => null, //all-access or no-access
        ]);

        Role::create([
            'name' => 'User',
            'slug' => 'user',
            'description' => 'User of the system',
            //'special' => null, //all-access or no-access
        ]);

        Role::create([
            'name' => 'Visitor',
            'slug' => 'visitor',
            'description' => 'The visitor',
            'special' => 'no-access', //all-access or no-access
        ]);

        echo 'The roles added!'.PHP_EOL;
    }
}
