<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function usersGet(){
        $users=User::all();
        foreach ($users as $key => $loop) {
            $loop->jCreated_at = verta($loop->created_at)->formatJalaliDate();
            $loop->jCreated_atDiff = verta($loop->created_at)->formatDifference();
        }
        return response()->json([
            'all' => $users
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
    public function update(Request $request){
        $userPost = json_decode($request['user']);

        $user = User::find($userPost->id);
        $user->name = $userPost->name;
        $user->mobile = $userPost->mobile;
        $user->insurance = $userPost->insurance;
        $user->card = $userPost->card;
        $user->bank = $userPost->bank;
        $user->account_code	 = $userPost->account_code;
        $user->etiquette = $userPost->etiquette;
        $user->comment = $userPost->comment;

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = time() . '-' . $userPost->id . '-avatar.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/avatar');
            $image->move($destinationPath, $name);
            $user->avatar = $name;
        }

            $user->save();

        $activity = new Activity([
            'code'    => 8002,
            'note'   => 'ویرایش کاربر',
            'user_id'   => $request['user_id'],
            'user_name'   => $request['user_name'],
        ]);
        $activity->save();
        return $this->usersGet();
    }

}
