<?php

use Illuminate\Database\Seeder;

class FieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\FieldParam::create([
            'name' => 'User image',
            'slug' => 'param_user_image',
            'default_value' => 'user.png',
            'description' => 'user profile image',
            'accessory_type' => \App\User::TYPE,
            'is_many_values' => 0,
            'is_required' => 1,
            'is_hidden' => 1,
        ]);
    }
}
