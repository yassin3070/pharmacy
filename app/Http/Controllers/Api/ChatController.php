<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Requests\Api\Chat\PrivateRoomRequest;
use App\Requests\Api\Chat\SendMessageRequest;
use App\Http\Resources\Chat\RoomResource;
use App\Http\Resources\Chat\MembersResource;
use App\Http\Resources\Chat\MessagesResource;
use App\Http\Resources\Chat\RoomsResource;
use App\Http\Resources\Chat\MessagesCollection;
use App\Models\MessageNotification;
use App\Models\User;
use App\Models\Room;
use App\Models\RoomMember;
use App\Services\ChatService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    use ApiResponseTrait;

    protected $chatService;

    /**
     * ChatController constructor.
     * 
     * @param ChatService $chatService
     */
    public function __construct(ChatService $chatService)
    {
       $this->chatService = $chatService;
    }

    /**
     * Create a new room for conversation.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function createRoom()
    {
        try {
            $room =$this->chatService->createRoom(auth()->user(), 'conversation');
            return $this->ApiResponse(['room' => $room], __('apis.fetched'), 200);
        } catch (\Exception $e) {
            Log::error('Error in createRoom', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500, $e->getMessage());
        }
    }

    /**
     * Create a private room with a specific member.
     * 
     * @param PrivateRoomRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPrivateRoom(PrivateRoomRequest $request)
    {
        try {
            $model = 'App\\Models\\' . $request->memberable_type;
            $memberable = $model::findOrFail($request->memberable_id);

            $room =$this->chatService->createPrivateRoom(auth()->user(), 'conversation', $memberable);
            $members =$this->chatService->getOtherRoomMembers($room, auth()->user());
           $this->chatService->seeRoomMessages($room, auth()->user());
            $roomMessagesQuery =$this->chatService->getRoomMessages($room, auth()->user());

            return $this->ApiResponse([
                'room' => new RoomResource($room->refresh()),
                'members' => MembersResource::collection($members),
                'messages' => new MessagesCollection($roomMessagesQuery)
            ], __('apis.created'), 200);
        } catch (\Exception $e) {
            Log::error('Error in createPrivateRoom', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500, $e->getMessage());
        }
    }

    /**
     * Retrieve all members of a room.
     * 
     * @param Room $room
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoomMembers(Room $room)
    {
        try {
            $members =$this->chatService->getRoomMembers($room, auth()->user());
            return $this->ApiResponse(['members' => $members], __('apis.fetched'), 200);
        } catch (\Exception $e) {
            Log::error('Error in getRoomMembers', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500, $e->getMessage());
        }
    }

    /**
     * Allow the user to join a room.
     * 
     * @param Room $room
     * @return \Illuminate\Http\JsonResponse
     */
    public function joinRoom(Room $room)
    {
        try {
           $this->chatService->joinRoom($room, auth()->user());
            return $this->ApiResponse(null, __('apis.joined'), 200);
        } catch (\Exception $e) {
            Log::error('Error in joinRoom', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500, $e->getMessage());
        }
    }

    /**
     * Allow the user to leave a room.
     * 
     * @param Room $room
     * @return \Illuminate\Http\JsonResponse
     */
    public function leaveRoom(Room $room)
    {
        try {
           $this->chatService->leaveRoom($room, auth()->user());
            return $this->ApiResponse(null, __('apis.left'), 200);
        } catch (\Exception $e) {
            Log::error('Error in leaveRoom', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500, $e->getMessage());
        }
    }

    /**
     * Send a message in a room.
     * 
     * @param SendMessageRequest $request
     * @param Room $room
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(SendMessageRequest $request, Room $room)
    {
        try {
            $senderLastMessage =$this->chatService->storeMessage($room, auth()->user(), $request->message);
            return $this->ApiResponse(['senderLastMessage' => $senderLastMessage], __('apis.sent'), 200);
        } catch (\Exception $e) {
            Log::error('Error in sendMessage', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500, $e->getMessage());
        }
    }

    /**
     * Upload a file to the room.
     * 
     * @param Request $request
     * @param Room $room
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadRoomFile(Request $request, Room $room)
    {
        try {
            $file =$this->chatService->uploadRoomFile($room, auth()->user(), $request->file);
            return $this->ApiResponse([
                'file_name' => $file['file_name'],
                'file_url' => $file['file_url']
            ], __('apis.uploaded'), 200);
        } catch (\Exception $e) {
            Log::error('Error in uploadRoomFile', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500, $e->getMessage());
        }
    }

    /**
     * Retrieve all messages from a room.
     * 
     * @param Room $room
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoomMessages(Room $room)
    {
        try {
            $members =$this->chatService->getOtherRoomMembers($room, auth()->user());
           $this->chatService->seeRoomMessages($room, auth()->user());
            $roomMessagesQuery =$this->chatService->getRoomMessages($room, auth()->user());

            return $this->ApiResponse([
                'room' => new RoomResource($room->refresh()),
                'members' => MembersResource::collection($members),
                'messages' => new MessagesCollection($roomMessagesQuery)
            ], __('apis.fetched'), 200);
        } catch (\Exception $e) {
            Log::error('Error in getRoomMessages', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500, $e->getMessage());
        }
    }

    /**
     * Get the count of unseen messages in a room.
     * 
     * @param Room $room
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoomUnseenMessages(Room $room)
    {
        try {
            $count =$this->chatService->getRoomUnseenMessagesCount($room, auth()->user());
            return $this->ApiResponse(['count' => $count], __('apis.fetched'), 200);
        } catch (\Exception $e) {
            Log::error('Error in getRoomUnseenMessages', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500, $e->getMessage());
        }
    }

    /**
     * Retrieve all rooms for the authenticated user.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMyRooms()
    {
        try {
            $rooms =$this->chatService->getUserRooms(auth()->user());
            return $this->ApiResponse([
                'rooms' => RoomsResource::collection($rooms)
            ], __('apis.fetched'), 200);
        } catch (\Exception $e) {
            Log::error('Error in getMyRooms', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500, $e->getMessage());
        }
    }

    /**
     * Retrieve all the messages for a specific room or create a room if not existing for the authenticated user.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMyMessagesWith($id)
    {
        try {
            $rooms_ids = auth()->user()->rooms()->pluck('room_id')->toArray();
            $receiver = RoomMember::query()->whereIn('room_id', $rooms_ids)
                ->where('memberable_id', $id)->first();

            if ($receiver) {
                $room = $receiver->room;
            } else {
                $room = auth()->user()->ownRooms()->create([
                    'type' => 'conversation',
                ]);

               $this->chatService->joinRoom($room, auth()->user());
               $this->chatService->joinRoom($room, User::query()->findOrFail($id));
            }

           $this->chatService->seeRoomMessages($room, auth()->user());
            $roomMessagesQuery =$this->chatService->getRoomMessages($room, auth()->user());
            $receiver =$this->chatService->getOtherRoomMembers($room, auth()->user())->first();

            return $this->ApiResponse([
                'room' => [
                    'id' => $room->id,
                ],
                'members' => MembersResource::collection($this->chatService->getOtherRoomMembers($room, auth()->user())),
                'messages' => new MessagesCollection($roomMessagesQuery),
            ], __('apis.fetched'), 200);
        } catch (\Exception $e) {
            \Log::error('Error retrieving messages or creating room', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500);
        }
    }

    /**
     * Delete a room.
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteRoom($id)
    {
        try {
            $room = Room::query()->where('id', $id)->first();

            if ($room) {
                $room->delete();
                return $this->ApiResponse(null, __('apis.deleted'), 200);
            } else {
                return $this->ApiResponse(null, __('apis.not_found'), 404);
            }
        } catch (\Exception $e) {
            \Log::error('Error deleting room', ['error' => $e->getMessage(), 'room_id' => $id]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500);
        }
    }


    /**
     * Delete a user's copy of a specific message.
     * 
     * @param MessageNotification $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteMessageCopy(MessageNotification $message)
    {
        try {
           $this->chatService->deleteMessageCopy($message, auth()->user());
            return $this->ApiResponse(null, __('apis.deleted'), 200);
        } catch (\Exception $e) {
            Log::error('Error in deleteMessageCopy', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500, $e->getMessage());
        }
    }
}
