<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Notifications\newUserRegistered;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
        'url'   => 'Home',
        ]);
        $activity->save();
        User::find(1)->notify(new newUserRegistered($activity));
        return view('home');
    }
}
