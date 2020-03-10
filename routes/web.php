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

//Dashboard Routes
Route::get('/dashboard/{vue_capture?}', 'DashboardController@index')->where('vue_capture', '[\/\w\.-]*');

//Dashboard Data
Route::post('/dashboard/get','DashboardController@read');


Route::group(['middleware' => ['auth']], function () {

    //    RoleController
    Route::get('admin/users/rolePer/get','RoleController@usersRolePerGet');
    Route::post('admin/users/permission/add','RoleController@addPermission');
    Route::post('admin/users/role/update', 'RoleController@updateRole');
    Route::post('admin/users/role/add','RoleController@addRole');
    Route::post('admin/users/permission/del','RoleController@delPer');
    Route::post('admin/users/role/del','RoleController@delRole');


    //ActivityController
    Route::get('activity/read', 'ActivityController@read');



    //UserController
    Route::post('admin/users/update','UserController@update');
    Route::get('admin/users/get','UserController@usersGet');
    Route::post('admin/users/del','UserController@destroy');



    //NotificationController
    Route::get('notification/read','NotificationController@read');
    Route::post('notification/markAllAsRead','NotificationController@markAllAsRead');



    //ContactController
    Route::post('contact/add','ContactController@add');
    Route::get('contact/read','ContactController@read');

});
