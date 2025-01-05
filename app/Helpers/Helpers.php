<?php
    /*
    |--------------------------------------------------------------------------
    | Detect Active URL Segment Function
    |--------------------------------------------------------------------------
    |
    | Compare given url segment with current url and return output if they match.
    | Very useful for navigation, marking if the link is active.
    |
    */

use App\Models\Setting;
use App\Models\User;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

    function isActiveURLSegment($pageSlug, $segment, $output = "active"){
        if (Request::segment($segment) == $pageSlug) return $output;
    }

    /*
    |--------------------------------------------------------------------------
    | Detect Active Panel Segment Function
    |--------------------------------------------------------------------------
    |
    | Compare given url segment with current url and return output if they match.
    | Very useful for navigation, marking if the link is active.
    |
    */
    function isActivePanelSegment($pageSlug, $segment, $output = "show"){
        if (Request::segment($segment) == $pageSlug) return $output;
    }


    // invoices
    // settings

    /*
    |--------------------------------------------------------------------------
    | Detect Active Route Function
    |--------------------------------------------------------------------------
    |
    | Compare given route with current route and return output if they match.
    | Very useful for navigation, marking if the link is active.
    |
    */
    function isActiveRoute($route, $output = "active"){
        if (Route::currentRouteName() == $route) return $output;
    }

    /*
    |--------------------------------------------------------------------------
    | Detect Active Routes Function
    |--------------------------------------------------------------------------
    |
    | Compare given routes with current route and return output if they match.
    | Very useful for navigation, marking if the link is active.
    |
    */
    function areActiveRoutes(Array $routes, $output = "active show"){
        foreach ($routes as $route){
            if (Route::currentRouteName() == $route) return $output;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Format SEO Page Slug Function
    |--------------------------------------------------------------------------
    |
    | Used to format the SEO Page Slug and return the formatted slug for
    | translations.
    |
    */
    function formatSEOPageSlug($pageSlug){
        return __('general.seo_'.str_replace("-", "_", $pageSlug).'_title');
    }


    function hasPermission($permission, $output = true){
        if (auth()->user()->can($permission)) return $output;
    }

    function hasAnyPermissions(Array $permissions, $output = true){
        foreach ($permissions as $permission){
            if (auth()->user()->can($permission)) return $output;
        }
    }


    function lang(){
        return App() -> getLocale();
    }

    function generateRandomCode(){
        return '1234';
        return rand(1111,4444);
    }

    if (!function_exists('languages')) {
      function languages() {
        return ['ar', 'en'];
      }
    }

    if (!function_exists('defaultLang')) {
      function defaultLang() {
        return 'ar';
      }
    }



    /*function pushNotification($tokens , $data , $platforms)
    {

        $url = 'https://fcm.googleapis.com/fcm/send';
        // $SERVER_API_KEY = Setting::where('key' , 'firebase_key')->first()->value ;
        $SERVER_API_KEY = "AAAAwYveauA:APA91bHoE9gzrCpVmRFSAx_Oqkljpz6FyHxcMeHAsRTpIDyhq4Iaii7IPCYuZ2atiLPQfVRZ0AHmnnIRme3Bn5d1kHNa1wB1VT5kq_Fxj-cE2hVLbH4i8kLEDAExW8wWpsryhlBefFLy" ;

        $Notify_data = [
            "registration_ids" => $tokens,
            "notification" => [
                "title"    => $data['title_'.lang()],
                "body"     =>  $data['body_'.lang()]  ,
                "mutable_content" => true,
                'sound'    => true,
            ],
            "notify_type"     => $data['type'] ?? null,
            'data'  => $data
        ];
        $dataString = json_encode($Notify_data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        return response()->json();

    }*/
   /**
     * Send push notifications to a list of device tokens using Firebase Cloud Messaging (FCM).
     *
     * @param array $tokens List of recipient device tokens.
     * @param array $data Notification data including title, body, and custom payload.
     * @param string $lang Language for notification title and body (default: 'ar').
     * @return \Illuminate\Http\JsonResponse
     */

if (!function_exists('user')) {
    function user($guard = 'sanctum'): ?User
    {
        return auth($guard)->user();
    }
}


function per_page($perPage = 10)
{
    if (request('per_page') == 'all') {
        return 999;
    }

    return request('per_page') ? (int)request('per_page') : $perPage;
}
function pushNotification($tokens, $data, $lang = 'ar')
    {
        $fcmService = new FcmService();

        try {
            foreach ($tokens as $token) {
                $titleKey = 'title_' . $lang;
                $bodyKey = 'body_' . $lang;

                $title = $data[$titleKey] ?? 'No Title';
                $body = $data[$bodyKey] ?? 'No Body';

                $flattenedData = [];
                foreach ($data as $key => $value) {
                    if (is_string($value) || is_numeric($value)) {
                        $flattenedData[$key] = (string)$value;
                    }
                }

                $response = $fcmService->sendNotification($token, $title, $body, $flattenedData);

                \Log::info('FCM Notification Sent', [
                    'token' => $token,
                    'response' => $response,
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'Notifications sent successfully.',
            ], 200);

        } catch (\Exception $e) {

            \Log::error('Error sending FCM notification', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Failed to send notifications.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    function convert2english( $string )
    {
        $newNumbers = range( 0, 9 );
        $arabic     = array( '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩' );
        $string     = str_replace( $arabic, $newNumbers, $string );
        return $string;
    }

    // function fixPhone( $string = null )
    // {
    //     if(!$string){
    //     return null;
    //     }

    //     $result = convert2english($string);
    //     $result = ltrim($result, '00');
    //     $result = ltrim($result, '0');
    //     $result = ltrim($result, '+');
    //     return $result;
    // }


    if (!function_exists('getCountryFromPhoneNumber')) {
        function getCountryFromPhoneNumber($phoneNumber)
        {
            $phoneUtil = PhoneNumberUtil::getInstance();

            try {
                $phoneNumberObj = $phoneUtil->parse($phoneNumber, null);
                $countryCode = $phoneUtil->getRegionCodeForNumber($phoneNumberObj);
                $countryName = $phoneUtil->getRegionDisplayName($countryCode);

                return [
                    'country_code' => $countryCode,
                    'country_name' => $countryName,
                ];
            } catch (NumberParseException $e) {
                return null;
            }
        }
    }


    if (!function_exists('formatPhoneNumber')) {
        function formatPhoneNumber($phoneNumber, $countryCode)
        {
            $phoneUtil = PhoneNumberUtil::getInstance();

            try {
                $phoneNumberObj = $phoneUtil->parse($phoneNumber, $countryCode);
                return $phoneUtil->format($phoneNumberObj, PhoneNumberFormat::NATIONAL);
            } catch (NumberParseException $e) {
                return null;
            }
        }
    }






?>
