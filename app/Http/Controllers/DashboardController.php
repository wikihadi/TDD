<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Notifications\newUserRegistered;
use App\User;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
    //    Notification::send($user, new newUserRegistered($activity));

        $user = Auth::user();
        $d=Carbon::now();

        return view('dashboard',compact('d','user'));
    }
}
