<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Activity;
use App\Notifications\newUserRegistered;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

//Route::group(['middleware' => 'web'], function () {

//    Route::auth();
    Route::get('/', function () {
        return view('welcome');
    });

        Auth::routes();

    //Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home',function (){
        return redirect('dashboard');
    });
    //Route::get('/markAsRead', function (){
    //    auth()->user()->unReadNotifications->markAsRead();
    //    return redirect()->back();
    //});
    //Route::get('/{any}', 'DashboardController@index')->where('any' , 'dashboard');
    //Route::get('/dashboard/{any}', 'DashboardController@index')->where('any' , '.*');
    Route::get('/dashboard/{vue_capture?}', function () {
        $activity = new Activity([
            'note'   => 'ورود',
            'user_id'   => Auth::id(),
            'url'   => 'dashboard',
        ]);
        $activity->save();
    //    Notification::send($user, new newUserRegistered($activity));
        $user = Auth::user();
        $unreadnotifications=$user->unReadNotifications();
        $readnotifications=$user->readNotifications();

        return view('dashboard',compact('user','unreadnotifications','readnotifications'));
    })->where('vue_capture', '[\/\w\.-]*');

//});
