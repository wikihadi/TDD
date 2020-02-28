<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Contact APIs
Route::post('contact/add','ContactController@add');
Route::get('contact/read','ContactController@read');

//Activity Apis
Route::get('activity/read','ActivityController@read');

//Notification Api
Route::get('notification/read','NotificationController@read');
Route::get('notification/markAllAsRead','NotificationController@markAllAsRead');


//Admin User
Route::get('admin/users/get','UserController@usersGet');
Route::post('admin/users/del','UserController@destroy');


//Role
Route::get('admin/users/rolePer/get','RoleController@usersRolePerGet');
Route::post('admin/users/rolePer/addPer','RoleController@addPer');
Route::post('admin/users/rolePer/addRole','RoleController@addRole');
Route::post('admin/users/rolePer/delPer','RoleController@delPer');
Route::post('admin/users/rolePer/delRole','RoleController@delRole');
