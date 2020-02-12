<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;
use App\User;

class NotificationController extends Controller
{
    public function __construct()
    {
        //
    }

    public function read(){
        $user_id = $_GET['user_id'];
        $user = User::find($user_id);
        return response()->json([
            'unReadNotifications' => $user->unReadNotifications,
            'readNotifications' => $user->readNotifications
        ]);
    }
    public function markAllAsRead(){
        $user_id = $_GET['user_id'];
        $user_name = $_GET['user_name'];
        $user = User::find($user_id);
        $user->unReadNotifications->markAsRead();
        $activity = new Activity([
            'code'    => 100,
            'note'   => 'مشاهده تمام اعلان ها',
            'user_id'   => $user_id,
            'user_name'   => $user_name,
        ]);
        $activity->save();
        return response()->json([
            'unReadNotifications' => $user->unReadNotifications,
            'readNotifications' => $user->readNotifications
        ]);
    }
}
