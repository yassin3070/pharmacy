<?php

namespace App\Traits;
use App\Services\FcmService;

trait  Firebase
{
    use NotificationMessageTrait ;

    public function sendFcmNotification($tokens = [] , $types = [] , $data = [], $lang = 'ar')
    {

        $fcmService = new FcmService();
        $results = [];
        foreach ($tokens as $token) {
            $titleKey = $data['title_ar'];
            $bodyKey = $data['body_ar'];

            $flattenedData = [];
            foreach ($data as $key => $value) {
                if (is_string($value) || is_numeric($value)) {
                    $flattenedData[$key] = (string)$value;
                }
            }
            $response =   $fcmService->sendNotification(
                $token,
                $titleKey,
                $bodyKey,
                $flattenedData
            );

            if (isset($response['success']) && $response['success']) {
                $results[] = [
                    'token' => $token,
                    'status' => 'success',
                    'message' => 'Notification sent successfully'
                ];
            } else {
                $results[] = [
                    'token' => $token,
                    'status' => 'failed',
                    'message' => $response ?? 'Unknown error'
                ];
            }

        }
        return response()->json($fcmService);
    }


}