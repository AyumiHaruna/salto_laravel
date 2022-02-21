<?php

namespace App\Http\Controllers;

use Validator;
use App\RoleUser;
use App\Roles;
use App\Permissions;
use App\PermissionRole;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use DateTime;

class RoleController extends Controller
{
    protected $user;
    protected $categoriaUsuario;
    protected $usuarioUsuario;

    /**
     * RoleController constructor.
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
     * Validates if the Rola hase the specified permission
     *
     * @return int
     */
    public function hasUsers($roleID){
         $query = DB::connection('mysql')->select('
                SELECT * FROM saltum_db.role_user 
                WHERE role_id = ?',[$roleID]);
         if(empty($query)){
            return false;
         }
         return true;

    }
    /**
     * Removes all the Role's Permissions
     *
     * @return void
     */
    public function removeAllPermissions($roleID){
         $query = DB::connection('mysql')->delete('
                DELETE FROM saltum_db.permission_role 
                WHERE role_id = ?',[$roleID]);
    }
    /**
     * Fetches the Roles's permissions
     *
     * @return int
     */
    public function getPermissions($roleID){
         $query = DB::connection('mysql')->select('
                SELECT * FROM saltum_db.permission_role 
                JOIN saltum_db.permissions ON permission_role.permission_id = permissions.id 
                WHERE role_id = ?',[$roleID]);
         if(empty($query)){
            return null;
         }
         return $query;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = [];
        $roleModel = Roles::select('*')->get();

        foreach($roleModel as $role):
            $item['id'] = $role->id;
            $item['name'] = $role->name;
            $item['display_name'] = $role->display_name;
            $item['description'] = $role->description;
            $item['permissions'] = $this->getPermissions($role->id);
            array_push($roles, $item);
        endforeach;

        $permissions = DB::table('permissions')
            ->get();
        $section = null;
        foreach(Session('menu_info') as $group){
            foreach($group->permissions as $menu_item){
                if($menu_item->id == 10){ // The Roles permission id is 10
                    $section = $menu_item;
                    break;
                }
            }
        }
        return view('admin.roles', [
            'section' => $section,
            'secondItem' => $permissions,
            'secondItemName' => 'Permisos',
            'mainItem' => $roles
        ]);
    }

    /**
     * Search resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $roles = [];
        $query = trim(Input::get('q'));
        $roleModel = Roles::where('name', 'LIKE', '%'.$query.'%')
            ->orwhere('display_name', 'LIKE', '%'.$query.'%')
            ->orwhere('description', 'LIKE', '%'.$query.'%')
            ->get();

        foreach($roleModel as $role):
            $item['id'] = $role->id;
            $item['name'] = $role->name;
            $item['display_name'] = $role->display_name;
            $item['description'] = $role->description;
            $item['permissions'] = $this->getPermissions($role->id);
            array_push($roles, $item);
        endforeach;
        $permissions = DB::table('permissions')
            ->get();
        $section = null;
        foreach(Session('menu_info') as $group){
            foreach($group->permissions as $menu_item){
                if($menu_item->id == 10){ // The Roles permission id is 10
                    $section = $menu_item;
                    break;
                }
            }
        }
        return view('admin.roles', [
            'section' => $section,
            'secondItem' => $permissions,
            'secondItemName' => 'Permisos',
            'mainItem' => $roles
        ]);
    }

    /**
     * Search resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function findByPermission($id)
    {
        $roles = [];
        $permissionRole = DB::table('roles')
            ->join('permission_role', 'roles.id', '=', 'permission_role.role_id')
            ->where('permission_role.permission_id',$id)->groupBy('roles.id')
            ->get();

        foreach($permissionRole as $role)
        {
            $item['id'] = $role->id;
            $item['name'] = $role->name;
            $item['display_name'] = $role->display_name;
            $item['description'] = $role->description;
            $item['permissions'] = $this->getPermissions($role->id);

            array_push($roles, $item);
        }
        $permissions = DB::table('permissions')
            ->get();
        $section = null;
        foreach(Session('menu_info') as $group){
            foreach($group->permissions as $menu_item){
                if($menu_item->id == 10){ // The Roles permission id is 10
                    $section = $menu_item;
                    break;
                }
            }
        }
        return view('admin.roles', [
            'section' => $section,
            'secondItem' => $permissions,
            'secondItemName' => 'Permisos',
            'mainItem' => $roles
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
            'name' => 'required|max:255',
            'display_name' => 'required|max:255',
            'description' => 'required|max:255'
        ]);

        if( $validator->fails() )
        {
            return redirect()->route('roles.index')->withErrors($validator, 'roleForm')->withInput();
        }

        $role = new Roles;
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();

        $datetime = new DateTime();
        $datetime = new DateTime(str_replace(' ', '', str_replace(' 0', ' ', $datetime->format('m/d/Y'))));
        foreach($request->input('permissions') as $permission){
            $ticketDB = DB::connection('mysql')->insert('
                INSERT INTO saltum_db.permission_role 
                    (permission_id, role_id, created_at, updated_at)
                    VALUES (?,?,?,?)',[$permission, $role->id, $datetime, $datetime]);
        }
        
        

        return redirect()->route('roles.index')->with([
            'status' => 200
        ]);
    }
    /**
     * Fetches the user given an id.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRoleById()
    {

        $role = Roles::find(Input::get('uid'));
        $response = [];

        if(empty($role))
        {
            return response()->json(['status' => 404, 'msg' => 'No se encontro el rol con id '.\Input::get('uid')], 404);
        }

        $response['id'] = $role['id'];
        $response['name'] = $role['name'];
        $response['display_name'] = $role['display_name'];
        $response['description'] = $role['description'];

        $response['permissions'] = $this->getPermissions($role['id']);

        return response()->json(['status' => 200, 'role' => $response], 200);

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
            'name' => 'required|max:255',
            'display_name' => 'required|max:255',
            'description' => 'required|max:255'
        ]);

        if( $validator->fails() )
        {
            return redirect()->route('roles.index')
                ->withErrors($validator, 'editRoleForm')
                ->withInput();
        }

        $role = Roles::find($request->input('uid'));
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');

        $role->save();
        $this->removeAllPermissions($request->input('uid'));

        $datetime = new DateTime();
        $datetime = new DateTime(str_replace(' ', '', str_replace(' 0', ' ', $datetime->format('m/d/Y'))));

        foreach($request->input('permissions') as $permission){
            $ticketDB = DB::connection('mysql')->insert('
                INSERT INTO saltum_db.permission_role 
                    (permission_id, role_id, created_at, updated_at)
                    VALUES (?,?,?,?)',[$permission, $role->id, $datetime, $datetime]);
        }
        
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
        foreach($uids as $roleid)
        {
            $role = Roles::find($roleid);
            if ($role)
            {
                if($role->id == 1)
                {
                    return response()->json([
                        'message' => 'El rol de administrador no puede se borrado de la base de datos.',
                        'code' => 405
                    ]);
                }else if( $this->hasUsers($roleid) ) {
                    return response()->json([
                        'message' => 'El rol no se puede eliminar si tiene usuarios asignados.',
                        'code' => 405
                    ]);
                }else{
                    $this->removeAllPermissions($roleid);
                    $query = DB::connection('mysql')->delete('
                        DELETE FROM saltum_db.roles 
                        WHERE id = ?',[$roleid]);
                }
            }
        };
        return response()->json(['message' => 'Elemento/s borrado/s con éxito. ']);
    }
}
