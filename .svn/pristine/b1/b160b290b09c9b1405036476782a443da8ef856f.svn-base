<?php

namespace App\Http\Controllers;

use Validator;
use App\RoleUser;
use App\Roles;
use App\User;
use App\Company;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use DateTime;

class UserController extends Controller
{
    protected $user;
    protected $categoriaUsuario;
    protected $usuarioUsuario;

    /**
     * UserController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    /**
     * Validates if the user belongs to the role
     *
     * @return int
     */
    public function hasRole($userID, $role){
         $user = DB::connection('mysql')->select('
                SELECT * FROM saltum_db.role_user
                WHERE user_id = ? AND role_id = ?',[$userID, $role]);
         if(empty($user)){
            return false;
         }
         return true;

    }
    /**
     * Fetches the User's role
     *
     * @return int
     */
    public function getRole($userID){
         $user = DB::connection('mysql')->select('
                SELECT role_id FROM saltum_db.role_user
                WHERE user_id = ?',[$userID]);
         if(empty($user)){
            return null;
         }
         return $user[0]->role_id;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = [];
        $usersModel = User::where('active','=',1)->get();

        foreach($usersModel as $user):
            $item['id'] = $user->id;
            $item['name'] = $user->name;
            $item['last_name'] = $user->last_name;
            $item['email'] = $user->email;
            $item['role'] = RoleUser::where('user_id','=',$user->id)->get();
            $item['role_name'] = Roles::where('id','=',$item['role'][0]->role_id)->get()[0]->display_name;
            $item['company'] = $user->company_id;
            $item['company_name'] = Company::where('id','=',$user->company_id)->get()[0]->display_name;
            array_push($users, $item);
        endforeach;

        $roles = DB::table('roles')
            ->get();
        $companies = DB::table('company')
            ->get();
        $section = null;
        foreach(Session('menu_info') as $group){
            foreach($group->permissions as $menu_item){
                if($menu_item->id == 11){ // The user permission id is 11
                    $section = $menu_item;
                    break;
                }
            }
        }

        // print_r($section );

        // print_r($section);
        return view('admin.users', [
            'section' => $section,
            'companies' => $companies,
            'secondItemName' => 'Roles',
            'mainItem' => $users,
            'secondItem' => $roles
        ]);
    }

    /**
     * Search resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $users = [];
        $query = trim(Input::get('q'));
        $usersModel = User::where('active','=',1)
            ->where('email', 'LIKE', '%'.$query.'%')
            ->orwhere('name', 'LIKE', '%'.$query.'%')
            ->orwhere('last_name', 'LIKE', '%'.$query.'%')
            ->get();

        foreach($usersModel as $user):
            $item['id'] = $user->id;
            $item['name'] = $user->name;
            $item['last_name'] = $user->last_name;
            $item['email'] = $user->email;
            $item['role'] = RoleUser::where('user_id','=',$user->id)->get();
            $item['role_name'] = Roles::where('id','=',$item['role'][0]->role_id)->get()[0]->display_name;
            $item['company'] = $user->company_id;
            $item['company_name'] = Company::where('id','=',$user->company_id)->get()[0]->display_name;
            array_push($users, $item);
        endforeach;

        $roles = DB::table('roles')
            ->get();
        $companies = DB::table('company')
            ->get();
        $section = null;
        foreach(Session('menu_info') as $group){
            foreach($group->permissions as $menu_item){
                if($menu_item->id == 11){ // The user permission id is 11
                    $section = $menu_item;
                    break;
                }
            }
        }
        return view('admin.users', [
            'section' => $section,
            'companies' => $companies,
            'secondItemName' => 'Roles',
            'mainItem' => $users,
            'secondItem' => $roles
        ]);
    }

    /**
     * Search resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function findByRole($id)
    {
        $usersArray = [];
        $usersRole = DB::table('role_user')
            ->join('users', 'users.id', '=', 'role_user.user_id')
            ->where('role_id',$id)
            ->where('users.active', 1)
            ->get();

        foreach($usersRole as $user)
        {
            $item['id'] = $user->id;
            $item['name'] = $user->name;
            $item['last_name'] = $user->last_name;
            $item['email'] = $user->email;
            $item['role'] = RoleUser::where('user_id','=',$user->id)->get();
            $item['role_name'] = Roles::where('id','=',$item['role'][0]->role_id)->get()[0]->display_name;
            $item['company'] = $user->company_id;
            $item['company_name'] = Company::where('id','=',$user->company_id)->get()[0]->display_name;
            array_push($usersArray, $item);
        }

        $roles = DB::table('Roles')
            ->get();
        $companies = DB::table('company')
            ->get();
        $section = null;
        foreach(Session('menu_info') as $group){
            foreach($group->permissions as $menu_item){
                if($menu_item->id == 11){ // The user permission id is 11
                    $section = $menu_item;
                    break;
                }
            }
        }
        return view('admin.users', [
            'section' => $section,
            'companies' => $companies,
            'secondItemName' => 'Roles',
            'mainItem' => $usersArray,
            'secondItem' => $roles
        ]);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6'
        ]);

        if( $validator->fails() )
        {
            return redirect()->route('users.index')->withErrors($validator, 'userForm')->withInput();
        }

        $user = new User;
        $user->name = ucwords( mb_strtolower($request->input('first_name'),'UTF-8') );
        $user->last_name = ucwords( mb_strtolower($request->input('last_name'),'UTF-8') );
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->company_id = $request->input('company');
        $user->active = 1;
        $user->save();

        $datetime = new DateTime();
        $datetime = new DateTime(str_replace(' ', '', str_replace(' 0', ' ', $datetime->format('m/d/Y'))));
        $ticketDB = DB::connection('mysql')->insert('
                INSERT INTO saltum_db.role_user
                    (user_id, role_id, created_at, updated_at)
                    VALUES (?,?,?,?)',[$user->id, $request->input('role'), $datetime, $datetime]);

        return redirect()->route('users.index')->with([
            'status' => 200
        ]);
    }
    /**
     * Fetches the user given an id.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserById()
    {

        $user = User::find(Input::get('uid'));
        $response = [];

        if(empty($user))
        {
            return response()->json(['status' => 404, 'msg' => 'No se encontro el usuario con id '.\Input::get('uid')], 404);
        }

        $response['id'] = $user['id'];
        $response['nombre'] = $user['name'];
        $response['apellidos'] = $user['last_name'];
        $response['email'] = $user['email'];
        $response['company'] = $user['company_id'];

        $response['role'] = $this->getRole($user['id']);

        return response()->json(['status' => 200, 'user' => $response], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'first_name' => 'required|max:255',
            'last_name' => 'max:255',
            'email' => 'required|email|max:255'
        ]);

        if( $validator->fails() )
        {
            return redirect()->route('users.index')
                ->withErrors($validator, 'editUserForm')
                ->withInput();
        }

        $user = $this->user->query()->find($request->input('uid'));

        $user->name = ucwords( mb_strtolower($request->input('first_name'),'UTF-8') );
        $user->last_name = ucwords( mb_strtolower($request->input('last_name'),'UTF-8') );
        $user->company_id = $request->input('company_edit');
        $user->save();
        $ticketDB = DB::connection('mysql')->update('
                UPDATE saltum_db.role_user
                SET role_id = ?
                WHERE user_id = ?',[$request->input('rol'), $user->id]);
        return redirect()->back()->with([
            'status' => 200
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $uids = explode(",",$request->input('uids'));
        foreach($uids as $userid)
        {
            $user = User::find($userid);
            if ($user)
            {
                if($user->id == 1)
                {
                    return response()->json([
                        'message' => 'El usuario administrador no puede se borrado de la base de datos.',
                        'code' => 405
                    ]);
                }else if( $this->hasRole($userid, 1) ) {
                    return response()->json([
                        'message' => 'El usuario actual no puede se borrado de la base de datos.',
                        'code' => 405
                    ]);
                }else{
                    $user->active = 0;
                    $user->save();
                }
            }
        };
        return response()->json(['message' => 'Elemento/s borrado/s con éxito.']);
    }
}
