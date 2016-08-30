<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->name = 'User';
        $user->email = 'user@user.com';
        $user->password = bcrypt('userpass');
        if ($user->save()){
            echo 'User created: email:user@user.com password:userpass'.PHP_EOL;
        }else{
            echo 'ERROR: User not created!'.PHP_EOL;
        }

        $role = \App\Role::where('slug','admin')->first();

        if ($user->assignRole($role->id) !== false){
            echo 'User added role: admin'.PHP_EOL;
        }else{
            echo 'ERROR: User not added role admin!'.PHP_EOL;
        }
    }
}
