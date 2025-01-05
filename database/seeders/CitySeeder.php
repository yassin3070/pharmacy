<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert(
            [

                ['name'   => json_encode(['ar' => 'الرياض' , 'en' => 'Riyadh']),
                'image'   => null
                ],
                ['name'   => json_encode(['ar' => 'مكة' , 'en' => 'Makkah']),
                'image'   => null
                ],
                ['name'   => json_encode(['ar' => 'جدة' , 'en' => 'Jeddah']),
                'image'   => null
                ],
                ['name'   => json_encode(['ar' => 'الدمام' , 'en' => 'Dammam']),
                'image'   => null
                ],
                ['name'   => json_encode(['ar' => 'الخبر' , 'en' => 'Khobar']),
                'image'   => null
                ],

        

            ]
        );
    }
}
