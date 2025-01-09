<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => json_encode(['ar' => ' الصحة ' , 'en' => 'Health']) ,
                'desc' => json_encode(['ar' => ' قسم أول ' , 'en' => 'First Category']) ,
                'image' => 'dashboard/assets/media/avatars/300-1.jpg' ,
                'is_active' => 1
            ],
            [
                'name' => json_encode(['ar' => ' العناية' , 'en' => 'Care']) ,
                'desc' => json_encode(['ar' => '  قسم ثاني' , 'en' => 'Second Category']) ,
                'image' => 'dashboard/assets/media/avatars/300-1.jpg' ,
                'is_active' => 1
            ],
            [
                'name' => json_encode(['ar' => ' قسم ثالث' , 'en' => 'Third Category']) ,
                'desc' => json_encode(['ar' => ' قسم ثالث' , 'en' => 'Third Category']) ,
                'image' => 'dashboard/assets/media/avatars/300-1.jpg' ,
//                'parent_id' => 1,
                'is_active' => 1
            ]
            ]);
    }
}
