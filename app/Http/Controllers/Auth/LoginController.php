<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use App\RoleUser;
use App\Roles;
use App\MenuItem;
use App\PermissionRole;
use App\Permissions;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/dashboard';

    protected function redirectTo()
    {
        // $this->middleware(function ($request, $next) {
            $user = Auth::user();
        //     return $next($request);
        // });
        //
        $role_user = RoleUser::where('user_id','=',$user['id'])->get();
        $role = Roles::where('id','=',$role_user[0]->role_id)->get();
        $groups = DB::table('permission_group')
            ->orderBy('id')
            ->get();
        $menu_info = [];
        foreach($groups as $group){
            $menu_item = new MenuItem();
            $menu_item->id = $group->id;
            $menu_item->group = 0;
            $menu_item->name = $group->name;
            $menu_item->display_name = $group->display_name;
            $menu_item->description = '';
            $menu_item->permissions = [];
            $menu_info[$menu_item->id] = $menu_item;
        }
        $permissions = DB::table('permission_role')
            ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
            ->where('role_id','=',$role_user[0]->role_id)
            ->get();
        foreach($permissions as $permission){
            $menu_item = new MenuItem();
            $menu_item->id = $permission->id;
            $menu_item->group = $permission->group_id;
            $menu_item->name = $permission->name;
            $menu_item->display_name = $permission->display_name;
            $menu_item->description = $permission->description;
            $menu_item->permissions = [];
            array_push($menu_info[$permission->group_id]->permissions, $menu_item);
        }
        Session::put(['user' => $user]);
        Session::put(['role' => $role_user[0]->role_id]);
        Session::put(['role_name' => $role[0]->display_name]);
        Session::put(['menu_info' => $menu_info]);

        // if (auth()->user()->role_id == 1) {
        //     return '/admin';
        // }
        // return '/Calendario';
        return '/Calendario';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
