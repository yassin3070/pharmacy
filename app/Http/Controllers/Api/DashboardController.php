<?php 
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OrderResource;
use App\Models\Order;
use App\Models\User;
use App\Requests\Api\AssignOrderRequest;
use App\Traits\ApiResponseTrait;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Twilio\Rest\Client;


class DashboardController extends Controller {

    use ApiResponseTrait,  UploadTrait;




    public function sendWhatsAppMessage()
    {
        $twilio = new Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));
    
        $message = $twilio->messages->create(
            'whatsapp:+1234567890', // Receiver's WhatsApp number
            [
                'from' => 'whatsapp:+0987654321', // Your WhatsApp number from Twilio
                'body' => 'test message', // Message body
            ]
        );
    
        // Handle the response or error as needed
        dd($message->sid);
    }
  
}