<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('socials')->insert([
            [
                'name' => json_encode(['ar' => 'فيس بوك' , 'en' => 'Facebook ']) ,
                'link' => "https://www.facebook.com",
                'is_active' => 1,
            ],
            [
                'name' => json_encode(['ar' => ' تويتر', 'en' => 'Twitter ']) ,
                'link' => "https://www.twitter.com",
                'is_active' => 1,

            ],
            [
                'name' => json_encode(['ar' => ' انستجرام', 'en' => 'Instagram ']) ,
                'link' => "https://www.instagram.com",
                'is_active' => 1,

            ]]);
    }
}
