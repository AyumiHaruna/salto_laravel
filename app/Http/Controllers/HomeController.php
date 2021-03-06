<?php

namespace App\Http\Controllers;

use App\RoleUser;
use App\Roles;
use App\MenuItem;
use App\PermissionRole;
use App\Permissions;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use App\User;
use Mail;

class HomeController extends Controller
{
    protected $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRole()
    {

    }

    // Send account validation mail
    public function sendRegConfirmMail()
    {

      $data['confirmation_code'] = $this->user['confirmation_code'];
      $data['name'] = $this->user['name'];
      $data['email'] = $this->user['email'];
      $data['id'] = $this->user['id'];

      Mail::send('auth.emails.confirmation', $data, function($message) use ($data){
          $message->to($data['email'])->subject("Activa tu cuenta - SALTUM");
          $message->from(env("MAIL_CONTACT"), 'Saltum');
      });
      return redirect('/dashboard');
    }

    // Test confirmation code and update account status
    public function accountVallidation($id, $code)
    {
      //get confirmation code with the user id
      $query = User::where('id', $id)->select('confirmation_code')->first();

      //test the confirmation_code
      if($query['confirmation_code'] == $code){
        //if is true, update account stat and change confirmation_code
        $token = str_random(20);
        $query = User::where('id', $id)->update([
          'confirmation_code' => $token,
          'active' => 1
        ]);
        return redirect('/dashboard')->with('status', '¡Cuenta validada exitosamente!');
      } else {
        //return error message
        return redirect('/dashboard')->with('status', 'El código de validación caducó');
      }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     // create session data
    public function index()
    {
        // $role_user = RoleUser::where('user_id','=',$this->user->id)->get();
        // $role = Roles::where('id','=',$role_user[0]->role_id)->get();
        // $groups = DB::table('permission_group')
        //     ->orderBy('id')
        //     ->get();
        // $menu_info = [];
        // foreach($groups as $group){
        //     $menu_item = new MenuItem();
        //     $menu_item->id = $group->id;
        //     $menu_item->group = 0;
        //     $menu_item->name = $group->name;
        //     $menu_item->display_name = $group->display_name;
        //     $menu_item->description = '';
        //     $menu_item->permissions = [];
        //     $menu_info[$menu_item->id] = $menu_item;
        // }
        // $permissions = DB::table('permission_role')
        //     ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
        //     ->where('role_id','=',$role_user[0]->role_id)
        //     ->get();
        // foreach($permissions as $permission){
        //     $menu_item = new MenuItem();
        //     $menu_item->id = $permission->id;
        //     $menu_item->group = $permission->group_id;
        //     $menu_item->name = $permission->name;
        //     $menu_item->display_name = $permission->display_name;
        //     $menu_item->description = $permission->description;
        //     $menu_item->permissions = [];
        //     array_push($menu_info[$permission->group_id]->permissions, $menu_item);
        // }
        // Session::put(['user' => $this->user]);
        // Session::put(['role' => $role_user[0]->role_id]);
        // Session::put(['role_name' => $role[0]->display_name]);
        // Session::put(['menu_info' => $menu_info]);
        //
        // return view('dashboard')->with('alert', (( Session('status')!= null )? Session('status') : '') );
    }

    // delete all session data
    public function logout()
    {
      Session()->flush();
      return redirect('/');
    }

}
