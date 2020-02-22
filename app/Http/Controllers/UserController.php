<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function usersGet(){
        return response()->json([
            'all' => User::all()
        ]) ;
    }
    public function usersRolePerGet(){
        return response()->json([
            'permissions' => Permission::all(),
            'roles' => Role::all()
        ]) ;
    }

//    add permission
    public function addPer(Request $request){


        $permission = Permission::create(['name' => $request['name']]);
        $activity = new Activity([
            'code'    => 8011,
            'note'   => 'افزودن دسترسی',
            'user_id'   => $request['user_id'],
            'user_name'   => $request['user_name'],
        ]);
        $activity->save();
        return $this->usersRolePerGet();
    }
//    del permission
    public function delPer(Request $request){
        $permission = Permission::find($request['del_id']);
        $activity = new Activity([
            'code'    => 8019,
            'note'   => 'حذف دسترسی',
            'user_id'   => $request['user_id'],
            'user_name'   => $request['user_name'],
        ]);
        $activity->save();
        $permission->delete();
        return $this->usersRolePerGet();
    }
    public function destroy(Request $request){
//        $id=$request['del_id'];
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
