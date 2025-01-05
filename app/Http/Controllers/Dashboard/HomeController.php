<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Social;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('welcomePage');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function welcomePage()
    {
        $data['about']           = Setting::where(['key' => 'about_' . App::getLocale()])->first()->value;
        $data['more_about']      = Setting::where(['key' => 'more_about_' . App::getLocale()])->first()->value;
        $data['policy']          = Setting::where(['key' => 'policy_' . App::getLocale()])->first()->value;
        $data['fav_icon']        = Setting::where(['key' => 'fav_icon'])->first()->value;
        $data['logo']            = Setting::where(['key' => 'logo'])->first()->value;
        $data['terms']           = Setting::where(['key' => 'terms_' . App::getLocale()])->first()->value;
        $data['android_version'] = Setting::where(['key' => 'android_version'])->first()->value;
        $data['app_name']        = Setting::where(['key' => 'app_name_' . App::getLocale()])->first()->value;
        $data['ios_version']     = Setting::where(['key' => 'ios_version'])->first()->value;
        $data['android_link']    = Setting::where(['key' => 'android_link'])->first()->value;
        $data['ios_link']        = Setting::where(['key' => 'ios_link'])->first()->value;
        $data['feature_image']   = Setting::where(['key' => 'feature_image_' . App::getLocale()])->first()->value;
        $data['feature_1_icon']  = Setting::where(['key' => 'feature_1_icon'])->first()->value;
        $data['feature_2_icon']  = Setting::where(['key' => 'feature_2_icon'])->first()->value;
        $data['feature_3_icon']  = Setting::where(['key' => 'feature_3_icon'])->first()->value;
        $data['feature_1_text']  = Setting::where(['key' => 'feature_1_text_' . App::getLocale()])->first()->value;
        $data['feature_2_text']  = Setting::where(['key' => 'feature_2_text_' . App::getLocale()])->first()->value;
        $data['feature_3_text']  = Setting::where(['key' => 'feature_3_text_' . App::getLocale()])->first()->value;
        $data['more_about']      = Setting::where(['key' => 'more_about_' . App::getLocale()])->first()->value;
        $data['footer']          = Setting::where(['key' => 'footer_' . App::getLocale()])->first()->value;

        $data['socials'] = Social::where('is_active', 1)->get();

        return view('welcome', compact('data'));
    }


    public function smsCounter()
    {
        return view('sms-counter');
    }
}
