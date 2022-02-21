<?php

namespace App\Http\Controllers;

use Validator;
use App\RoleUser;
use App\Roles;
use App\Permissions;
use App\PermissionRole;
use App\User;
use App\Company;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use DateTime;

class CompanyController extends Controller
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
        $companies = [];
        $companyModel = Company::select('*')->get();

        foreach($companyModel as $company):
            $item['id'] = $company->id;
            $item['name'] = $company->name;
            $item['display_name'] = $company->display_name;
            array_push($companies, $item);
        endforeach;

        $roles = [];
        $section = null;
        foreach(Session('menu_info') as $group){
            foreach($group->permissions as $menu_item){
                if($menu_item->id == 20){ // The Company permission id is 20
                    $section = $menu_item;
                    break;
                }
            }
        }
        return view('admin.company', [
            'section' => $section,
            'secondItem' => $roles,
            'secondItemName' => '',
            'mainItem' => $companies
        ]);
    }

    /**
     * Search resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $companies = [];
        $query = trim(Input::get('q'));
        $companynModel = Company::where('name', 'LIKE', '%'.$query.'%')
            ->orwhere('display_name', 'LIKE', '%'.$query.'%')
            ->get();

        foreach($companynModel as $company):
            $item['id'] = $company->id;
            $item['name'] = $company->name;
            $item['display_name'] = $company->display_name;
            array_push($companies, $item);
        endforeach;
        $roles =[];
        $section = null;
        foreach(Session('menu_info') as $group){
            foreach($group->permissions as $menu_item){
                if($menu_item->id == 20){ // The Company permission id is 20
                    $section = $menu_item;
                    break;
                }
            }
        }
        return view('admin.company', [
            'section' => $section,
            'secondItem' => $roles,
            'secondItemName' => '',
            'mainItem' => $companies
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
            'display_name' => 'required|max:255'
        ]);

        if( $validator->fails() )
        {
            return redirect()->route('company.index')
                ->withErrors($validator, 'companyForm')
                ->withInput();
        }

        $company = new Company;
        $company->name = $request->input('name');
        $company->display_name = $request->input('display_name');
        $company->save();

        return redirect()->route('company.index')->with([
            'status' => 200
        ]);
    }
    /**
     * Fetches the permission given an id.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCompanyById()
    {

        $company = Company::find(Input::get('uid'));
        $response = [];

        if(empty($company))
        {
            return response()->json(['status' => 404, 'msg' => 'No se encontro la empresa con id '.\Input::get('uid')], 404);
        }

        $response['id'] = $company['id'];
        $response['name'] = $company['name'];
        $response['display_name'] = $company['display_name'];

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
            'display_name' => 'required|max:255'
        ]);

        if( $validator->fails() )
        {

            return redirect()->route('company.index')
                ->withErrors($validator, 'editCompanyForm')
                ->withInput();
        }

        $company = Company::find($request->input('uid'));
        $company->name = $request->input('name');
        $company->display_name = $request->input('display_name');

        $company->save();
        
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
        foreach($uids as $companyId)
        {
            $company = Company::find($companyId);
            if ($company)
            {
                $query = DB::connection('mysql')->delete('
                    DELETE FROM saltum_db.company 
                    WHERE id = ?',[$companyId]);
            }
        };
        return response()->json(['message' => 'Elemento/s borrado/s con éxito. ']);
    }
}
