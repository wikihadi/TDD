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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home',function (){
    return redirect('dashboard');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard/{vue_capture?}', function () {
        $user = Auth::user();
        $activity = new Activity([
            'note'   => 'ورود',
            'user_id'   => $user->id,
            'url'   => 'dashboard',
        ]);
        $activity->save();
//    Notification::send($user, new newUserRegistered($activity));
        return view('dashboard');
    })->where('vue_capture', '[\/\w\.-]*');

});
