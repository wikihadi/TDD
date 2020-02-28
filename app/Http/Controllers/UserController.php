<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function usersGet(){
        return response()->json([
            'all' => User::all()
        ]) ;
    }

    public function destroy(Request $request){

        User::find($request['del_id'])->delete();
        $activity = new Activity([
            'code'    => 8009,
            'note'   => 'حذف کاربر',
            'user_id'   => $request['user_id'],
            'user_name'   => $request['user_name'],
        ]);
        $activity->save();
        return $this->usersGet();
    }

}
