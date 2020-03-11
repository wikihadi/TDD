<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Notifications\newUserRegistered;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function usersGet(){
        $users=User::with('roles')->get();
        foreach ($users as $key => $loop) {
            $loop->jCreated_at = verta($loop->created_at)->formatJalaliDate();
            $loop->jCreated_atDiff = verta($loop->created_at)->formatDifference();
        }
        $myId=Auth::id();
        $me=User::find($myId)->with('roles')->first();
        $myRoles=$me->roles;
        return response()->json([
            'all' => $users,
            'me' => $me,
            'rolesAll' => Role::all(),
            'myRoles' => $myRoles,
        ]) ;
    }

    public function destroy(Request $request){
        $user =  Auth::user();

        User::find($request['del_id'])->delete();
        $activity = new Activity([
            'code'    => 8009,
            'note'   => 'حذف کاربر',
            'user_id'   => $user->id,
            'user_name'   => $user->name,
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
        $userNotif=$user;
        $actUser=Auth::user();

        if ($request['changedRole']==='true') {
            $user->syncRoles($userPost->roles);


            $activity = new Activity([
                'code'    => 8002,
                'note'   => 'ویرایش نقش کاربری',
                'user_id'   => $actUser->id,
                'user_name'   => $actUser->name,
            ]);
            $activity->save();

            Notification::send($userNotif, new newUserRegistered($activity));
        }else{
            $activity = new Activity([
                'code'    => 8002,
                'note'   => 'ویرایش کاربر',
                'user_id'   => $actUser->id,
                'user_name'   => $actUser->name,
            ]);
            $activity->save();

        }

        $user->save();


        return $this->usersGet();
    }

}
