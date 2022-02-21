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

class PermissionController extends Controller
{
    protected $user;

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
     * Validates if the Permission is associated with a Role
     *
     * @return int
     */
    public function hasRole($permissionID, $roleID){
         $query = DB::connection('mysql')->select('
                SELECT * FROM saltum_db.permission_role 
                WHERE permission_id = ? AND role_id = ?',[$permissionID, $roleID]);
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
    public function removeAllPermissions($permissionID){
         $query = DB::connection('mysql')->delete('
                DELETE FROM saltum_db.permission_role 
                WHERE permission_id = ?',[$permissionID]);
    }
    /**
     * Fetches the Roles asociated with the given permission
     *
     * @return int
     */
    public function getRoles($permissionID){
         $query = DB::connection('mysql')->select('
                SELECT * FROM saltum_db.permission_role 
                JOIN saltum_db.roles ON permission_role.role_id = roles.id 
                WHERE permission_id = ?',[$permissionID]);
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
        $permissions = [];
        $permissionModel = Permissions::select('*')->get();

        foreach($permissionModel as $permission):
            $item['id'] = $permission->id;
            $item['name'] = $permission->name;
            $item['display_name'] = $permission->display_name;
            $item['description'] = $permission->description;
            array_push($permissions, $item);
        endforeach;

        $roles = DB::table('roles')
            ->get();
        $section = null;
        foreach(Session('menu_info') as $group){
            foreach($group->permissions as $menu_item){
                if($menu_item->id == 9){ // The Permisos permission id is 9
                    $section = $menu_item;
                    break;
                }
            }
        }
        return view('admin.permissions', [
            'section' => $section,
            'secondItem' => $roles,
            'secondItemName' => 'Roles',
            'mainItem' => $permissions
        ]);
    }

    /**
     * Search resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $permissions = [];
        $query = trim(Input::get('q'));
        $permissionModel = Permissions::where('name', 'LIKE', '%'.$query.'%')
            ->orwhere('display_name', 'LIKE', '%'.$query.'%')
            ->orwhere('description', 'LIKE', '%'.$query.'%')
            ->get();

        foreach($permissionModel as $permission):
            $item['id'] = $permission->id;
            $item['name'] = $permission->name;
            $item['display_name'] = $permission->display_name;
            $item['description'] = $permission->description;
            array_push($permissions, $item);
        endforeach;
        $roles = DB::table('roles')
            ->get();
        $section = null;
        foreach(Session('menu_info') as $group){
            foreach($group->permissions as $menu_item){
                if($menu_item->id == 9){ // The Permisos permission id is 9
                    $section = $menu_item;
                    break;
                }
            }
        }
        return view('admin.permissions', [
            'section' => $section,
            'secondItem' => $roles,
            'secondItemName' => 'Roles',
            'mainItem' => $permissions
        ]);
    }

    /**
     * Search resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function findByRole($id)
    {
        $permissions = [];
        $permissionRole = DB::table('permissions')
            ->join('permission_role', 'permissions.id', '=', 'permission_role.permission_id')
            ->where('permission_role.role_id',$id)->groupBy('permissions.id')
            ->get();

        foreach($permissionRole as $permission)
        {
            $item['id'] = $permission->id;
            $item['name'] = $permission->name;
            $item['display_name'] = $permission->display_name;
            $item['description'] = $permission->description;

            array_push($permissions, $item);
        }
        $roles = DB::table('roles')
            ->get();
        $section = null;
        foreach(Session('menu_info') as $group){
            foreach($group->permissions as $menu_item){
                if($menu_item->id == 9){ // The Permisos permission id is 9
                    $section = $menu_item;
                    break;
                }
            }
        }
        return view('admin.permissions', [
            'section' => $section,
            'secondItem' => $roles,
            'secondItemName' => 'Roles',
            'mainItem' => $permissions
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
            return redirect()->route('permissions.index')->withErrors($validator, 'permissionForm')->withInput();
        }

        $permission = new Permissions;
        $permission->name = $request->input('name');
        $permission->display_name = $request->input('display_name');
        $permission->description = $request->input('description');
        $permission->save();

        return redirect()->route('permissions.index')->with([
            'status' => 200
        ]);
    }
    /**
     * Fetches the permission given an id.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPermissionById()
    {

        $permission = Permissions::find(Input::get('uid'));
        $response = [];

        if(empty($permission))
        {
            return response()->json(['status' => 404, 'msg' => 'No se encontro el permiso con id '.\Input::get('uid')], 404);
        }

        $response['id'] = $permission['id'];
        $response['name'] = $permission['name'];
        $response['display_name'] = $permission['display_name'];
        $response['description'] = $permission['description'];

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
            return redirect()->route('permissions.index')
                ->withErrors($validator, 'editPermissionForm')
                ->withInput();
        }

        $permission = Permissions::find($request->input('uid'));
        $permission->name = $request->input('name');
        $permission->display_name = $request->input('display_name');
        $permission->description = $request->input('description');

        $permission->save();
        
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
        foreach($uids as $permissionid)
        {
            $permission = Permissions::find($permissionid);
            if ($permission)
            {
                $this->removeAllPermissions($permissionid);
                $query = DB::connection('mysql')->delete('
                    DELETE FROM saltum_db.permissions 
                    WHERE id = ?',[$permissionid]);
            }
        };
        return response()->json(['message' => 'Elemento/s borrado/s con éxito. ']);
    }
}
