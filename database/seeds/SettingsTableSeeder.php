<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Settings

        # Cache
        \App\Setting::create([
            'slug' => 'cache_status',
            'name' => 'Caching status',
            'description' => 'Cache status',
            'value' => 1,
            'is_bool' => 1,
        ]);
        \App\Setting::create([
            'slug' => 'cache_lifetime',
            'name' => 'Caching',
            'description' => 'Cache lifetime in seconds',
            'value' => 3600,
            'is_bool' => 0,
        ]);
    }
}
