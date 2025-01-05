<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\SMS;
use App\Requests\dashboard\UpdateSettingRequest;
use App\Services\SettingService;
use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    private $modal;

    public function __construct(Setting $modal){

        $this->modal = $modal;

    }


    public function index()
    {
        $data =  SettingService::appInformations( $this->modal->pluck('value', 'key'));

        $gateways = SMS::latest()->get();

        return view('dashboard.settings' , compact('data' , 'gateways'));
    }

    public function update(Request $request)
    {
        foreach ( $request->all() as $key => $val ){
            if (in_array($key , ['logo' , 'fav_icon' , 'default_user' , 'intro_loader' , 'intro_logo'  ,'about_image_2' , 'about_image_1' , 'login_background','landing_background_image_ar', 'landing_background_image_en', 'feature_1_icon', 'feature_2_icon', 'feature_3_icon', 'feature_image_en', 'feature_image_ar',])) {
                $img           = Image::make($val);

                if($key == 'default_user'){
                    $thumbsPath    = 'storage/images/users/default.png';
                }else if ($key == 'no_data') {
                    $thumbsPath    = 'storage/images/no_data.png';
                }else{
                    $name          = time() . rand(1000000, 9999999) . '.' . $val->getClientOriginalExtension();
                    $thumbsPath    = 'storage/images/settings/'.$name;
                    $this->modal->where( 'key', $key ) -> update( [ 'value' => $thumbsPath ] );
                }

                // Create the directory if it doesn't exist
                if (!File::exists(dirname($thumbsPath))) {
                    File::makeDirectory(dirname($thumbsPath), 0755, true, true);
                }

                $img->save($thumbsPath);
            }else if($val){
                $this->modal->where( 'key', $key )->update(['value' => $val]);
            }
        }
        if ($request->is_production) {
            $this->modal->where( 'key', 'is_production' ) -> update( [ 'value' => 1 ] );
        }else{
            $this->modal->where( 'key', 'is_production' ) -> update( [ 'value' => 0 ] );
        }

        return SettingService::appInformations($this->modal->pluck('value', 'key'));


    }


    public function updateSms(Request $request)
    {
        SMS::where('id' , $request->sms_id)->update($request->except('_token' , 'sms_id'));
        return response()->json();
    }



    public function SetLanguage($lang)
    {

        if ( in_array( $lang, [ 'ar', 'en' ] ) ) {

            if ( session() -> has( 'lang' ) )
                session() -> forget( 'lang' );

            session() -> put( 'lang', $lang );

        } else {
            if ( session() -> has( 'lang' ) )
                session() -> forget( 'lang' );

            session() -> put( 'lang', 'ar' );
        }
        return back();
    }

}
