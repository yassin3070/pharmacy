<?php

namespace App\Services;

use App\Http\Resources\Api\OrderResource;
use App\Http\Resources\Api\UserResource;
use App\Http\Resources\Api\WalletTransactionResource;

class PushNotificationService
{
    /**
     * Generic Push Notification Handler
     */
    private static function send($tokens, $title_ar, $title_en, $body_ar, $body_en, $type, $id, $status, $data, $lang)
    {
        $result = [
            'title_ar' => $title_ar,
            'title_en' => $title_en,
            'body_ar'  => $body_ar,
            'body_en'  => $body_en,
            'type'     => $type,
            'id'       => $id,
            'status'   => $status,
            'data'     => $data,
        ];

        pushNotification($tokens, $result, $lang);

        return $result;
    }

    /**
     * Order Notification
     */
    public static function AssignOrderNotification($tokens, $data, $lang = 'ar')
    {
        return self::send(
            $tokens,
            'طلب رقم # ' . $data->order_num,
            'Order Number # ' . $data->order_num,
            'لديك طلب جديد',
            'You have new order',
            'order',
            $data->id,
            $data->status,
            new OrderResource($data),
            $lang
        );
    }


    /**
     * Order Status Change Notification
     */
    public static function setOrderStatusNotification($tokens, $data, $lang = 'ar')
    {
        return self::send(
            $tokens,
            'طلب رقم # ' . $data->order_num,
            'Order Number # ' . $data->order_num,
            'لقد تم تغيير حالة الطلب',
            'Order Status changed by provider',
            'order',
            $data->id,
            $data->status,
            new OrderResource($data),
            $lang
        );
    }

    /**
     * New Message Notification
     */
    public static function newMessageNotification($tokens, $data, $lang = 'ar')
    {
        return self::send(
            $tokens,
            'رسالة جديدة',
            'New Message',
            'لديك رسالة جديدة',
            'You have a new message',
            'chat',
            $data->id,
            $data->status,
            new UserResource($data),
            $lang
        );
    }

    /**
     * Rate Notification
     */
    public static function setRateNotification($tokens, $data, $lang = 'ar')
    {
        return self::send(
            $tokens,
            'طلب رقم # ' . $data->order_num,
            'Order Number # ' . $data->order_num,
            'لديك تقييم جديد',
            'You have new rate',
            'rate',
            $data->id,
            $data->status,
            new OrderResource($data),
            $lang
        );
    }
}
