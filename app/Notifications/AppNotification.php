<?php

namespace App\Notifications;

use App\Services\PushNotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Traits\Firebase;

class AppNotification extends Notification
{
    use Queueable, Firebase;

    protected $tokens, $data, $type, $lang;

    public function __construct($data, $tokens, $type, $lang)
    {
        $this->tokens = $tokens;
        $this->data   = $data;
        $this->type   = $type;
        $this->lang   = $lang;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        // Check if notifications are enabled for the user
        if (!$notifiable->is_notify)  $this->tokens =[]; 
        
            switch ($this->type) {
                case 'new-order':
                    return PushNotificationService::AssignOrderNotification($this->tokens, $this->data, $this->lang);

                case 'order-status':
                    return PushNotificationService::setOrderStatusNotification($this->tokens, $this->data, $this->lang);

                case 'rate-order':
                    return PushNotificationService::setRateNotification($this->tokens, $this->data, $this->lang);

                case 'new-message':
                    return PushNotificationService::newMessageNotification($this->tokens, $this->data, $this->lang);

                default:
                    return null; // Handle unknown types gracefully
            }
        
        return null; 
    }
}
