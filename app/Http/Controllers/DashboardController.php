<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Notifications\newUserRegistered;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $activity = new Activity([
            'note'   => 'ورود',
            'user_id'   => Auth::id(),
            'url'   => 'dashboard',
        ]);
        $activity->save();
//        $user = Auth::user();
//        User::find(1)->notify(new newUserRegistered($activity));
//        Notification::send($user, new newUserRegistered($activity));
        return view('dashboard');
    }
}
