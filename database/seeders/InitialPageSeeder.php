<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitialPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('initial_pages')->insert([
            [
                'title' => json_encode(['ar' => 'صفحة اولي' , 'en' => 'first page']) ,
                'desc' => json_encode(['ar' => 'صفحة اولي' , 'en' => 'first page']) ,
                'image' => 'logo/hwzn.png' ,
                'order' => 1,
                'is_active'  => 1
            ],
            [
                'title' => json_encode(['ar' => 'صفحة ثانية' , 'en' => 'second page']) ,
                'desc' => json_encode(['ar' => 'صفحة ثانية' , 'en' => 'second page']) ,
                'image' => 'logo/hwzn.png' ,
                'order' => 2 ,
                'is_active'  => 1

            ],
            [
                'title' => json_encode(['ar' => 'صفحة ثالثة' , 'en' => 'third page']) ,
                'desc' => json_encode(['ar' => 'صفحة ثالثة' , 'en' => 'third page']) ,
                'image' => 'logo/hwzn.png' ,
                'order' => 3,
                'is_active'  => 1

            ]
            ]);
    }
}
