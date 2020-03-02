<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        //
    }

    public function read(){
        $user = Auth::user();
        return response()->json([
            'unReadNotifications' => $user->unReadNotifications,
            'readNotifications' => $user->readNotifications
        ]);
    }
    public function markAllAsRead(){
        $user = Auth::user();
        $user->unReadNotifications->markAsRead();
        $activity = new Activity([
            'code'    => 100,
            'note'   => 'مشاهده تمام اعلان ها',
            'user_id'   => $user->id,
            'user_name'   => $user->name,
        ]);
        $activity->save();
        return response()->json([
            'unReadNotifications' => $user->unReadNotifications,
            'readNotifications' => $user->readNotifications
        ]);
    }
}
