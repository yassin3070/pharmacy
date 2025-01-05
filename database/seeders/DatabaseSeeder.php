<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(SmsSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(SocialTableSeeder::class);
        $this->call(InitialPageSeeder::class);
    }
}
