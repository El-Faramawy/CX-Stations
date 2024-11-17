<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Models\Notification;

class NotificationController extends Controller
{
    use PaginateTrait;

    public function notifications()
    {
        $notifications = Notification::where('user_id', user_api()->id());
        $notifications->update(['is_read' => true]);
        return $this->apiResponse($notifications);
    }

    public function getNotificationsCount()
    {
        $notificationsCount = Notification::where('user_id', user_api()->id())->where('is_read', false)->count();
        return $this->apiResponse($notificationsCount, null, 'simple');
    }

}
