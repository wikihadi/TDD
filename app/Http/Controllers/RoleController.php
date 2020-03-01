<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
//        $this->middleware('auth');

//        $this->middleware('permission:role-list');
//        $this->middleware('permission:role-create', ['only' => ['create','store']]);
//        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    public function usersRolePerGet(){
        return response()->json([
            'permissions' => Permission::all(),
            'roles' => Role::with('permissions')->get()
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
//    add Role
    public function addRole(Request $request){


        $role = Role::create(['name' => $request['name']]);

        $permissions = explode(",",$request['permissions']);
            $role->syncPermissions($permissions);

        $activity = new Activity([
            'code'    => 8021,
            'note'   => 'افزودن نقش',
            'user_id'   => $request['user_id'],
            'user_name'   => $request['user_name'],
        ]);
        $activity->save();
        return $this->usersRolePerGet();
    }
//    update Role
    public function updateRole(Request $request){

        $role = Role::findById($request['id']);
        if ($role['name']!==$request['name']){
            $role['name']=$request['name'];
            $role->save();
        }
        $permissions = explode(",",$request['permissions']);
        $role->syncPermissions($permissions);
        $activity = new Activity([
            'code'    => 8022,
            'note'   => 'ویرایش نقش',
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
//    del Role
    public function delRole(Request $request){
        $Role = Role::find($request['del_id']);
        $activity = new Activity([
            'code'    => 8029,
            'note'   => 'حذف نقش',
            'user_id'   => $request['user_id'],
            'user_name'   => $request['user_name'],
        ]);
        $activity->save();
        $Role->delete();
        return $this->usersRolePerGet();
    }
}
