<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Roles;
use App\RoleUser;
use App\Sessions;
use App\usersXcoaches;
use Illuminate\Support\Facades\Auth;
use Validator;

class PassportController extends Controller
{
  public $successStatus = 200;

  /**
   * login api
   *
   * @return \Illuminate\Http\Response
   */
  public function login(){
    if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
      $user = Auth::user();
      $success['token'] =  $user->createToken('MyApp')->accessToken;
      return response()->json(['user' => $success], $this->successStatus);
    }else{
      return response()->json(['error'=>'Unauthorised'], 401);
    }
  }

  /**
   * Register api
   *
   * @return \Illuminate\Http\Response
   */
  public function register(Request $request){
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'last_name' => 'required',
      'birthdate' => 'date_format:"Y-m-d',
      'email' => 'required|email|unique:users',
      'password' => 'required',
      'c_password' => 'required|same:password',
    ]);
    if ($validator->fails()) {
      return response()->json(['error'=>$validator->errors()], 401);
    }
    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    $success['token'] =  $user->createToken('MyApp')->accessToken;
    $success['name'] =  $user->name;
    $success['last_name'] =  $user->last_name;
    $success['birthdate'] =  $user->birthdate;
    $success['email'] =  $user->email;
    $success['photo'] =  $user->photo;

    return response()->json(['success'=>$success], $this->successStatus);
  }

  /**
   * auth details api
   *
   * @return \Illuminate\Http\Response
   */
  public function getDetails(){
    $user = Auth::user();
    // get user Role
    $role = Roles::join('role_user', 'role_user.role_id', '=', 'roles.id')
            ->where('role_user.user_id', '=', $user->id)
            ->first();
    return response()->json(['success' => $user, 'role' => $role], $this->successStatus);
  }

  /**
   * Get Session List details api
   *
   * @return \Illuminate\Http\Response
   */
  public function getSessionList(Request $request){
    $validator = Validator::make($request->all(), [
      'startDate' => 'required|max:255|date_format:"Y-m-d"|after:"2015-01-01"',
      'endDate' => 'required|max:255|date_format:"Y-m-d"|after:"2015-01-01"',
      'role' => 'required' // 0 si es coach,  1 si es coachee
    ]);
    if ($validator->fails()) {
      return response()->json(['error'=>$validator->errors()], 401);
    }

    // get coach
    $user = Auth::user();
    if($_GET['role'] == 0){  // es coach?)
      $coach = $user->id;
    }else{
      $coach = usersXcoaches::where('id_user', '=', $user->id)->first();
      $coach = $coach->id_coach;
    }
    $startDate = date('Y-m-d', strtotime($_GET['startDate']));
    $endDate = date('Y-m-d', strtotime($_GET['endDate']));
    //get general data of session
    $sesiones = Sessions::join('users as coach', 'sessions.coach_id', '=', 'coach.id')
        ->join('users as coachee', 'sessions.coachee_id', '=', 'coachee.id')
        ->select('sessions.*', 'coach.name as coach_name', 'coach.last_name as coach_last_name', 'coachee.name as coachee_name', 'coachee.last_name as coachee_last_name')
        ->whereDate('start_datetime', '>=', $startDate)
        ->whereDate('end_datetime', '<=', date('Y-m-d'))
        ->where('coach_id', '=', $coach);
    if(isset($_GET['status'])){
      $sesiones = $sesiones->where('status', '=', $_GET['status']);
    }
    $sesiones = $sesiones->get();

    return response()->json(['data' => $sesiones], $this->successStatus);
  }

  /**
   * session details api 
   *
   * @return \Illuminate\Http\Response
   */
  public function getSessionDetails($id){
    //get general data of session
    $sesiones = Sessions::join('users as coach', 'sessions.coach_id', '=', 'coach.id')
        ->join('users as coachee', 'sessions.coachee_id', '=', 'coachee.id')
        ->select('sessions.*', 'coach.name as coach_name', 'coach.last_name as coach_last_name', 'coachee.name as coachee_name', 'coachee.last_name as coachee_last_name')
        ->where('sessions.id', $id)->first();

    return response()->json(['data' => $sesiones], $this->successStatus);
  }

  /**
   * Modifica el estatus de una sesión.
   *
   * @return El estatus de la sesión o 'error' si no se pudo cambiar.
   */
  public function sessionUpdate($id, $value){

    $query = Sessions::where('id', $id)->update([ 'status' => $value ]);

    $query = Sessions::where('id', $id)->select('status')->first();

    if($query['status'] == $value){
      return $value;
    } else {
      return 'error';
    }
  }


  /**
   * Obtiene el estatus de una sesión
   *
   * @return El estatus de la sesión o 'error' si no se encontró.
   */
  public function sessionStatus($id){
    $status = Sessions::where('id', $id)->select('status')->first();

    if($status['status'] != null){
      return $status['status'];
    } else {
      return 'error';
    }
  }


  /**
   * Califica la sesión impartida por el coach y calificada por el cliente.
   *
   * @return \Illuminate\Http\Response
   */
  public function pointSession($id, $point){
    $query = Sessions::where('id', $id)->update([
      'status' => 3,
      'eval' => $point
    ]);
    if($query != 0){
      return response()->json(['success'=>'Se calificó exitosamente.'], $this->successStatus);
    }else{
      return response()->json(['success'=>'No se encontró la sesión que se quiere calificar.'], $this->successStatus);
    }
  }


}
