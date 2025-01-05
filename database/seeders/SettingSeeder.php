<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            ['key' => 'sms_counter', 'type' => 'number', 'value' => 0],
            ['key' => 'app_name_ar', 'type' => 'text', 'value' => 'هوزن'],
            ['key' => 'app_name_en', 'type' => 'text', 'value' => 'HWZN'],
            ['key' => 'firebase_key', 'type' => 'text', 'value' => 'AAAAi0Y_HnY:APA91bGeuHqUXsXiwWMDlJ-tenEOiKmRZ7pfifFPvI0XUzUiIRD6togg468docAR0gdTpY40Yvr50I8610Fdm9jG3RT-iYakNLthfVcxViBSJ6lIzt5gVh77Y_4VY3oqYyP64Svx6QxR'],
            ['key' => 'app_percentage', 'type' => 'number', 'value' => 10],
            ['key' => 'logo', 'type' => 'image', 'value' => 'website/images/logo.png'],
            ['key' => 'about_ar', 'type' => 'textarea', 'value' => 'هوزن تك'],
            ['key' => 'about_en', 'type' => 'textarea', 'value' => 'HWZN'],
            ['key' => 'terms_ar', 'type' => 'textarea', 'value' => 'هوزن تك'],
            ['key' => 'terms_en', 'type' => 'textarea', 'value' => 'HWZN'],
            ['key' => 'policy_ar', 'type' => 'textarea', 'value' => 'هوزن تك'],
            ['key' => 'policy_en', 'type' => 'textarea', 'value' => 'HWZN'],
            ['key' => 'vision_ar', 'type' => 'textarea', 'value' => 'هوزن تك'],
            ['key' => 'vision_en', 'type' => 'textarea', 'value' => 'HWZN'],
            ['key' => 'mission_ar', 'type' => 'textarea', 'value' => 'هوزن تك'],
            ['key' => 'mission_en', 'type' => 'textarea', 'value' => 'HWZN'],
            ['key' => 'whyus_ar', 'type' => 'textarea', 'value' => 'هوزن تك'],
            ['key' => 'whyus_en', 'type' => 'textarea', 'value' => 'HWZN'],
            ['key' => 'facebook', 'type' => 'link', 'value' => 'https://www.facebook.com/'],
            ['key' => 'twitter', 'type' => 'link', 'value' => 'https://www.twitter.com/'],
            ['key' => 'instagram', 'type' => 'link', 'value' => 'https://www.instagram.com/'],
            ['key' => 'youtube', 'type' => 'link', 'value' => 'https://www.youtube.com/'],
            ['key' => 'whatsapp', 'type' => 'link', 'value' => 'https://www.whatsapp.com/'],
            ['key' => 'snapchat', 'type' => 'link', 'value' => 'https://www.snapchat.com/'],
            ['key' => 'slogan_en', 'type' => 'text', 'value' => 'HWZN'],
            ['key' => 'slogan_ar', 'type' => 'text', 'value' => 'هوزن'],
            ['key' => 'email', 'type' => 'text', 'value' => 'admin@gmail.com'],
            ['key' => 'phone', 'type' => 'text', 'value' => '1346546464'],
            ['key' => 'address', 'type' => 'text', 'value' => 'العنوان'],
            ['key' => 'android_version', 'type' => 'text', 'value' => '1.0'],
            ['key' => 'ios_version', 'type' => 'text', 'value' => '2.0'],
            ['key' => 'android_link', 'type' => 'link', 'value' => 'https://www.android.com/'],
            ['key' => 'ios_link', 'type' => 'link', 'value' => 'https://www.apple.com/'],
            ['key' => 'fav_icon', 'type' => 'image', 'value' => 'website/images/logo.ico'],
            ['key' => 'landing_background_image_ar', 'type' => 'image', 'value' => 'website/images/banner-bg.png'],
            ['key' => 'landing_background_image_en', 'type' => 'image', 'value' => 'website/images/banner-bg.png'],
            ['key' => 'feature_1_icon', 'type' => 'image', 'value' => 'website/images/features-icon-1.png'],
            ['key' => 'feature_2_icon', 'type' => 'image', 'value' => 'website/images/features-icon-1.png'],
            ['key' => 'feature_3_icon', 'type' => 'image', 'value' => 'website/images/features-icon-1.png'],
            ['key' => 'feature_1_text_ar', 'type' => 'text', 'value' => 'سهولة البحث عن مزودي الخدمة حسب المدينة.'],
            ['key' => 'feature_1_text_en', 'type' => 'text', 'value' => 'Easy Search For Service Providers By City.'],
            ['key' => 'feature_2_text_ar', 'type' => 'text', 'value' => 'عرض حسابات مقدمي العطاءات سواء كانت شركات أو أفراد'],
            ['key' => 'feature_2_text_en', 'type' => 'text', 'value' => 'View The Accounts Of Bidders, Whether Companies Or Individuals'],
            ['key' => 'feature_3_text_ar', 'type' => 'text', 'value' => 'فحص الأعمال السابقة وتقييمات مقدمي الخدمة.'],
            ['key' => 'feature_3_text_en', 'type' => 'text', 'value' => 'Examination Of Previous Works And Evaluations Of Service Providers.'],
            ['key' => 'feature_image_en', 'type' => 'image', 'value' => 'website/images/left-image.png'],
            ['key' => 'feature_image_ar', 'type' => 'image', 'value' => 'website/images/left-image.png'],
            ['key' => 'portfolio', 'type' => 'file', 'value' => 'website/files/'],
            ['key' => 'more_about_ar', 'type' => 'textarea', 'value' => 'هوزن تك'],
            ['key' => 'more_about_en', 'type' => 'textarea', 'value' => 'HWZN'],
            ['key' => 'footer_en', 'type' => 'text', 'value' => 'Copyright © 2023 HWZN Landing Page'],
            ['key' => 'footer_ar', 'type' => 'text', 'value' => 'جميع الحقوق محفوظة 2023 هوزن '],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                ['type' => $setting['type'], 'value' => $setting['value']]
            );
        }
    }
}
