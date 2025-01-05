<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    use ApiResponseTrait;

    private $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Retrieve all notifications for the authenticated user.
     * Marks all unread notifications as read.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNotifications(Request $request)
    {
        try {
            // Validate pagination parameters
            $validatedData = $request->validate([
                'per_page' => 'integer|min:1',
                'page' => 'integer|min:1',
            ]);

            $perPage = $validatedData['per_page'] ?? 10;

            $data = $this->notificationService->getNotifications($perPage);

            return $this->ApiResponse($data, __('apis.fetched'), 200);
        } catch (\Exception $e) {
            \Log::error('Error retrieving notifications', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500);
        }
    }

    /**
     * Count the number of unread notifications for the authenticated user.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function countUnreadNotifications()
    {
        try {
            $count = $this->notificationService->countUnreadNotifications();
            return $this->ApiResponse(['count' => $count], null, 200);
        } catch (\Exception $e) {
            \Log::error('Error counting unread notifications', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500);
        }
    }

    /**
     * Delete a specific notification for the authenticated user.
     * 
     * @param string $notification_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteNotification($notification_id)
    {
        try {
            $deleted = $this->notificationService->deleteNotification($notification_id);
            if (!$deleted) {
                return $this->ApiResponse(null, __('apis.notification_not_found'), 404);
            }
            return $this->ApiResponse(null, __('apis.notification_deleted'), 200);
        } catch (\Exception $e) {
            \Log::error('Error deleting notification', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500);
        }
    }

    /**
     * Delete all notifications for the authenticated user.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteNotifications()
    {
        try {
            $this->notificationService->deleteNotifications();
            return $this->ApiResponse(null, __('apis.notifications_deleted'), 200);
        } catch (\Exception $e) {
            \Log::error('Error deleting all notifications', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500);
        }
    }
}
