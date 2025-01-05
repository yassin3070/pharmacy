<?php

namespace App\Services;

use App\Http\Resources\Api\NotificationResource;
use Illuminate\Support\Facades\Auth;

class NotificationService
{
    /**
     * Retrieve all notifications for the authenticated user and mark unread as read.
     * 
     * @param int $perPage
     * @return array
     */
    public function getNotifications(int $perPage = 10): array
    {
        // Mark all unread notifications as read
        Auth::user()->unreadNotifications->markAsRead();

        // Retrieve notifications with pagination
        $notifications = NotificationResource::collection(
            Auth::user()->notifications()->paginate($perPage)
        );

        // Retrieve counts
        $totalCount = Auth::user()->notifications()->count();

        return [
            'notifications' => $notifications,
            'total_count' => $totalCount,
        ];
    }

    /**
     * Count the number of unread notifications for the authenticated user.
     * 
     * @return int
     */
    public function countUnreadNotifications(): int
    {
        return Auth::user()->unreadNotifications->count();
    }

    /**
     * Delete a specific notification for the authenticated user.
     * 
     * @param string $notificationId
     * @return bool
     */
    public function deleteNotification(string $notificationId): bool
    {
        return Auth::user()->notifications()->where('id', $notificationId)->delete();
    }

    /**
     * Delete all notifications for the authenticated user.
     * 
     * @return bool
     */
    public function deleteNotifications(): bool
    {
        return Auth::user()->notifications()->delete();
    }
}
