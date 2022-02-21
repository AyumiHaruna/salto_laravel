<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use App\Payments;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use DateTime;

class BillingController extends Controller
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

    }

    /**
     * Display a listing of the billings.
     *
     * @return \Illuminate\Http\Response
     */
    public function billing()
    {
        $payments = [];
        $paymentModel = Payments::select('*')
                            ->join('users', 'users.id', '=', 'payments.user_id')
                            ->join('plans', 'plans.id', '=', 'payments.plan')
                            ->join('first_payment', 'first_payment.id', '=', 'payments.first_payment')
                            ->orderBy('payment_datetime', 'desc')
                            ->get();

        foreach($paymentModel as $payment):
            $item['id'] = $payment->id;
            $item['user_id'] = $payment->user_id;
            $item['amount'] = $payment->amount;
            $item['name'] = $payment->name.' '.$payment->last_name;
            $item['plan'] = $payment->plan_name;
            $item['payment_datetime'] = $payment->payment_datetime;
            $item['first_payment'] = $payment->fp_description;
            array_push($payments, $item);
        endforeach;

        $roles = [];
        $section = null;
        foreach(Session('menu_info') as $group){
            foreach($group->permissions as $menu_item){
                if($menu_item->id == 12){ // The Billing permission id is 20
                    $section = $menu_item;
                    break;
                }
            }
        }
        return view('billing.billing', [
            'section' => $section,
            'secondItem' => $roles,
            'secondItemName' => '',
            'mainItem' => $payments
        ]);
    }

    /**
     * Display a listing of the billings.
     *
     * @return \Illuminate\Http\Response
     */
    public function invoices()
    {
        $invoices = [];
        $paymentModel = Payments::select('*')->where('invoice', '=', 1)->get();

        foreach($paymentModel as $invoice):
            $item['id'] = $invoice->id;
            $item['user_id'] = $invoice->user_id;
            $item['plan'] = $invoice->plan;
            $item['payment_datetime'] = $invoice->payment_datetime;
            $item['amount'] = $invoice->amount;
            $item['invoice_rfc'] = $invoice->invoice_rfc;
            $item['invoice_email'] = $invoice->invoice_email;
            $item['invoice_address'] = $invoice->invoice_address;
            $item['invoice_name'] = $invoice->invoice_name;
            array_push($invoices, $item);
        endforeach;

        $roles = [];
        $section = null;
        foreach(Session('menu_info') as $group){
            foreach($group->permissions as $menu_item){
                if($menu_item->id == 8){ // The Invoices permission id is 8
                    $section = $menu_item;
                    break;
                }
            }
        }
        return view('billing.invoices', [
            'section' => $section,
            'secondItem' => $roles,
            'secondItemName' => '',
            'mainItem' => $invoices
        ]);
    }

    /**
     * Search payments.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchBilling()
    {
        $payments = [];
        $query = trim(Input::get('q'));
        $paymentModel = Payments::join('users', 'users.id', '=', 'payments.user_id')
            ->join('plans', 'plans.id', '=', 'payments.plan')
            ->join('first_payment', 'first_payment.id', '=', 'payments.first_payment')
            ->where('name', 'LIKE', '%'.$query.'%')
            ->orwhere('plan_name', 'LIKE', '%'.$query.'%')
            ->orwhere('fp_description', 'LIKE', '%'.$query.'%')
            ->get();

        foreach($paymentModel as $payment):
            $item['id'] = $payment->id;
            $item['user_id'] = $payment->user_id;
            $item['amount'] = $payment->amount;
            $item['name'] = $payment->name.' '.$payment->last_name;
            $item['plan'] = $payment->plan_name;
            $item['payment_datetime'] = $payment->payment_datetime;
            $item['first_payment'] = $payment->fp_description;
            array_push($payments, $item);
        endforeach;
        $roles =[];
        $section = null;
        foreach(Session('menu_info') as $group){
            foreach($group->permissions as $menu_item){
                if($menu_item->id == 12){ // The Billing permission id is 20
                    $section = $menu_item;
                    break;
                }
            }
        }
        return view('billing.billing', [
            'section' => $section,
            'secondItem' => $roles,
            'secondItemName' => '',
            'mainItem' => $payments
        ]);
    }

    /**
     * Search for invoices.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchInvoices()
    {
        $invoices = [];
        $query = trim(Input::get('q'));
        $paymentModel = Payments::where('invoice', '=', 1)
            ->where('invoice_name', 'LIKE', '%'.$query.'%')
            ->orwhere('invoice_rfc', 'LIKE', '%'.$query.'%')
            ->orwhere('invoice_email', 'LIKE', '%'.$query.'%')
            ->orwhere('amount', 'LIKE', '%'.$query.'%')
            ->orwhere('payment_datetime', 'LIKE', '%'.$query.'%')
            ->get();

        foreach($paymentModel as $invoice):
            $item['id'] = $invoice->id;
            $item['user_id'] = $invoice->user_id;
            $item['plan'] = $invoice->plan;
            $item['payment_datetime'] = $invoice->payment_datetime;
            $item['amount'] = $invoice->amount;
            $item['invoice_rfc'] = $invoice->invoice_rfc;
            $item['invoice_email'] = $invoice->invoice_email;
            $item['invoice_address'] = $invoice->invoice_address;
            $item['invoice_name'] = $invoice->invoice_name;
            array_push($invoices, $item);
        endforeach;
        $roles =[];
        $section = null;
        foreach(Session('menu_info') as $group){
            foreach($group->permissions as $menu_item){
                if($menu_item->id == 8){ // The Invoices permission id is 8
                    $section = $menu_item;
                    break;
                }
            }
        }
        return view('billing.invoices', [
            'section' => $section,
            'secondItem' => $roles,
            'secondItemName' => '',
            'mainItem' => $invoices
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
