<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\ChatService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ChatService $chat)
    {
        $this->chat = $chat;
        $this->middleware('guest')->except('logout', 'chat' , 'conversation' , 'sendMessage');

    }

    public function chat()
    {
        $rooms = $this->chat->getUserRooms(auth()->user());
       return view('dashboard.chats.index' , compact('rooms'));
    }
   
    public function conversation($room_id)
    {

        $room    = Room::find($room_id);
        if (!$room) {
            return $this->ApiResponse(null, __('site.noRoom') , 404);
        }
           
        $rooms = $this->chat->getUserRooms(auth()->user());
     
        $this->chat->seeRoomMessages($room, auth()->user());
        $messages = $this->chat->getRoomMessagesResource($room,  auth()->user());

        $members = $this->chat->getOtherRoomMembers($room,  auth()->user())->first();
       return view('dashboard.chats.chat' ,compact( 'room','messages','members' , 'rooms'));
    }

    public function sendMessage(Request $request)
    {
        $attributes = $request->all();

        if($request->has('file')){

            $attributes['message'] = $this->StoreFile('chats' , $request->file);

        }else{
            $attributes['message'] = $request->message;
        }
        $room    = Room::find($request->room_id);

       $message =  $this->chat->storeMessage($room, auth()->user(), $request->message);

        return response()->json(['success' => __('تم ارسال رسالة') , 'message' => $attributes['message']  , 'data' => $message]);
    }
}
