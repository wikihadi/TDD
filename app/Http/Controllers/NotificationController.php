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
        $userUnReadNotifications=$user->unReadNotifications;
        $userReadNotifications=$user->readNotifications;

        foreach ($userUnReadNotifications as $key => $loop) {
            $loop->jCreated_at = verta($loop->created_at)->formatJalaliDate();
            $loop->jCreated_atDiff = verta($loop->created_at)->formatDifference();
        }
        foreach ($userReadNotifications as $key => $loop) {
            $loop->jCreated_at = verta($loop->created_at)->formatJalaliDate();
            $loop->jCreated_atDiff = verta($loop->created_at)->formatDifference();
        }
        return response()->json([
            'unReadNotifications' => $userUnReadNotifications,
            'readNotifications' => $userReadNotifications
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
        $this->read();
    }
}
