<?php

namespace App\Notifications;

use App\Traits\Firebase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyAdmin extends Notification
{
    use Queueable , Firebase;
    private $MessageData;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->MessageData = [
            'sender'        => auth()->id(),
            'sender_model'  => 'User',
            'title_ar'      => (string) $request['title_ar'],
            'title_en'      => (string) $request['title_en'],
            'body_ar'       => $request['body_ar'],
            'body_en'       => $request['body_en'],
            'type'          => 'admin_notify' ,
        ];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if(count($notifiable->devices)){
            $tokens = $notifiable->devices->pluck('device_id')->toArray(); 
            $types  = $notifiable->devices->pluck('device_type')->toArray(); 
            
            $this->sendFcmNotification($tokens ,$types ,$this->MessageData , $notifiable->lang) ;
        }
        return $this->MessageData;
       
    }
}
