<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Coach_config;
use App\Sessions;
use App\User;
use App\Tokens;
use App\UsersXcoaches;
use Session;
use Validator;
use Carbon\Carbon;

class SessionController extends Controller
{
    //---------------------------------
    //        ADMIN FUNCTIONS
    //---------------------------------
    //  return admin calendar view
    public function index()
    {
      $section = $this->getPageTitle(2);

      // if is admin
      if( Session('role') == 1){
          $currentMonth = date('Y-m-').'01';
          $previousMonth = date('Y-m-d', strtotime("-2 months", strtotime($currentMonth)));
          $lastMonth = date('Y-m-d', strtotime("+3 months", strtotime($currentMonth)));

          //get session
          $sessions = Sessions::join('users', 'sessions.coach_id', '=', 'users.id')
                      ->select('sessions.*', 'users.name as coach_name', 'users.last_name as coach_last_name')
                      ->whereBetween('start_datetime', [$previousMonth, $lastMonth])
                      ->where('sessions.status','!=',5)
                      ->orderBy('sessions.start_datetime')
                      ->get();

          //Get names
          for ($x=0; $x < count($sessions) ; $x++) {
                if( $sessions[$x]['coachee_id'] != 0 ){
                  $query = User::where('id', $sessions[$x]['coachee_id'])->first();
                  $sessions[$x]['coachee_name'] = $query['name'];
                  $sessions[$x]['coachee_last_name'] = $query['last_name'];
                } else {
                  $sessions[$x]['coachee_name'] = '';
                  $sessions[$x]['coachee_last_name'] = '';
                }
              }

          //obtenemos conteos de sesiones para dministrador
          $adminData = [];
          $adminData['dadas'] = Sessions::where('status', 3)->orWhere('status', 8)->orWhere('status', 9)->orWhere('status', 10)->count();
          $adminData['proximas'] = Sessions::where('status', 1)->orWhere('status', 0)->count();
          $adminData['canceladas'] = Sessions::where('status', 2)->orWhere('status', 4)->count();
          //get first session date =
          $firstSession = Sessions::where('status', 0)->orWhere('status', 1)->orWhere('status', 2)->orWhere('status', 3)->orderBy('start_datetime')->select('start_datetime')->first();
          $firstSession = ((isset($firstSession['start_datetime']))? new Carbon($firstSession['start_datetime']) : Carbon::now());
          $today = Carbon::now();

          $dayDiff = $firstSession->diffInDays($today);
          $weekDiff = $firstSession->diffInWeeks($today);
          $monthDiff = $firstSession->diffInMonths($today);
          $yearDiff = $firstSession->diffInYears($today);

          $adminData['promDiarias'] = (( $dayDiff > 0 )? ( $adminData['dadas'] / $dayDiff ) : $adminData['dadas'] );
          $adminData['promSemana'] = (( $weekDiff > 0 )? ( $adminData['dadas'] / $weekDiff ) : $adminData['dadas'] );
          $adminData['promMes'] = (( $monthDiff > 0 )? ( $adminData['dadas'] / $monthDiff ) : $adminData['dadas'] );
          $adminData['promAnual'] = (( $yearDiff > 0 )? ( $adminData['dadas'] / $yearDiff ) : $adminData['dadas'] );

          return view( 'calendar.admin_index' )->with([
            'section' => $section,
            // 'sessions' => json_encode($sessions),
            'sessions' => $sessions,
            // 'coaches' => $coaches,
            'previousMonth' => $previousMonth,
            'lastMonth' => $lastMonth,
            'adminData' => $adminData
          ]);
      }     //end if is admin
    }




    //----------------------------------------
    //             GENERAL FUNCTIONS
    //----------------------------------------
    //get the title of this page
    public function getPageTitle( $sectionNumber )
    {
      $permission = DB::table('permission_role')
          ->where('role_id','=',Session('role'))
          ->where('permission_id','=',$sectionNumber)
          ->get();

      $section = null;
      foreach(Session('menu_info') as $group){
          foreach($group->permissions as $menu_item){
              if($menu_item->id == $sectionNumber){ // The Calendar permission id is 2
                  $section = $menu_item;
                  break;
              }
          }
      }

      return $section;
    }







    // // return calendar view
    // public function index()
    // {
    //     $currentMonth = date('Y-m-').'01';
    //     $previousMonth = date('Y-m-d', strtotime("-2 months", strtotime($currentMonth)));
    //     $lastMonth = date('Y-m-d', strtotime("+3 months", strtotime($currentMonth)));
    //
    //     if( Session('role') == 4 )      // if is a coach
    //     {
    //       //get if there's a coach configurations ( just for info )
    //       $coach_config = Coach_config::where('coach_id','=',Session('user')->id)->first();
    //       //get all his/her sessions
    //       $sessions = Sessions::join('users', 'sessions.coach_id', '=', 'users.id')
    //           ->select('sessions.*', 'users.name as coach_name', 'users.last_name as coach_last_name')
    //           ->whereBetween('start_datetime', [$previousMonth, $lastMonth])
    //           ->where('sessions.coach_id','=',Session('user')->id)->orderBy('sessions.start_datetime')->get();
    //
    //     }
    //     else            // if isn??t coach
    //     {
    //       //other role not has/uses any config
    //       $coach_config = null;
    //
    //       if(!ISSET($_GET['id']) || $_GET['id'] == 0 ){     //all sessiones
    //         $sessions = Sessions::join('users', 'sessions.coach_id', '=', 'users.id')
    //             ->select('sessions.*', 'users.name as coach_name', 'users.last_name as coach_last_name')
    //             ->where('sessions.coachee_id', Session('user')->id)
    //             ->whereBetween('start_datetime', [$previousMonth, $lastMonth])
    //             ->orWhere('sessions.status','=',5)
    //             ->orderBy('sessions.start_datetime')
    //             ->get();
    //       } else {        //selected coach sessions
    //         $sessions = Sessions::join('users', 'sessions.coach_id', '=', 'users.id')
    //             ->select('sessions.*', 'users.name as coach_name', 'users.last_name as coach_last_name')
    //             ->where('sessions.coachee_id', Session('user')->id)
    //             ->whereBetween('start_datetime', [$previousMonth, $lastMonth])
    //             ->orWhere(function ($query) {
    //                             $query->where('sessions.status','=',5)
    //                                   ->where('sessions.coach_id', $_GET['id']);
    //                       })
    //             ->orderBy('sessions.start_datetime')
    //             ->get();
    //             // ->where('sessions.status','=',5)->where('session.coach_id', $_GET['id'])->get();
    //       }
    //     }
    //
    //     for ($x=0; $x < count($sessions) ; $x++) {
    //       if( $sessions[$x]['coachee_id'] != 0 ){
    //         $query = User::where('id', $sessions[$x]['coachee_id'])->first();
    //         $sessions[$x]['coachee_name'] = $query['name'];
    //         $sessions[$x]['coachee_last_name'] = $query['last_name'];
    //       } else {
    //         $sessions[$x]['coachee_name'] = '';
    //         $sessions[$x]['coachee_last_name'] = '';
    //       }
    //     }
    //
    //     //get avalible coaches
    //     // FALTA LIMITAR LOS COACHES QUE PUEDES VER
    //     $coaches = DB::table('users')
    //         ->join('role_user', 'role_user.user_id', '=', 'users.id')
    //         ->where('role_id','=',4)
    //         ->get();
    //
    //     // // get user data
    //     // $users = User::where('id','!=',Session('user')->id)->get();
    //     //
    //     $section = null;
    //     foreach(Session('menu_info') as $group){
    //         foreach($group->permissions as $menu_item){
    //             if($menu_item->id == 2){ // The Calendar permission id is 2
    //                 $section = $menu_item;
    //                 break;
    //             }
    //         }
    //     }
    //
    //     return view('calendar.index', [
    //         'section' => $section,
    //         'sessions' => json_encode($sessions),
    //         'coaches' => $coaches,
    //         'coach_config' => $coach_config,
    //         'previousMonth' => $previousMonth,
    //         'lastMonth' => $lastMonth
    //     ]);
    // }
    //
    // // store a new session from coach
    // public function store(Request $request)
    // {
    //     //validate data
    //     $validator = Validator::make($request->all(),[
    //         'name' => 'required|max:255',
    //         'description' => 'required|max:255',
    //         'coach_id' => 'required|max:255',
    //         'start_datetime' => 'required|max:255|date_format:"Y-m-d H:i:s"|after:"'.date('Y-m-d').'"',
    //         // 'end_datetime' = > 'required|max:255|date_format:"Y-m-d H:i:s"|after:start_datetime'
    //     ]);
    //
    //     if( $validator->fails() )
    //     {
    //         return redirect()->route('Calendario.index')->withErrors($validator, 'mainForm')
    //           ->with('type', 'config')->with('session_id',0)->withInput();
    //     }
    //
    //     //get range of dates
    //     $start_datetime = new \DateTime( substr( $_POST['start_datetime'], 0, 16 ) );
    //     $end_datetime = new \DateTime( substr( $_POST['start_datetime'], 0, 16 ) );
    //     $end_datetime = $end_datetime->modify('+29 minutes');
    //
    //     //get old_sessions created between the new datetimes
    //     $old_query = Sessions::where('coach_id', $request->coach_id)
    //       ->whereBetween('start_datetime', [$start_datetime, $end_datetime])->get();
    //
    //     //if the number of $old_query != 0, test if old_sessions are deletable
    //     if( count($old_query) != 0){
    //       for($x=0; $x<count($old_query); $x++)
    //       {
    //         $canDelete = 1;
    //         if( $old_query[$x]['status'] != 5 && $old_query[$x]['status'] != 2 )
    //         {
    //           $canDelete = 0;   //to send error
    //           $errorMsg = 'No se puede sobreescribir la sesi??n del '.$old_query[$x]['start_datetime'];
    //           break;
    //         }
    //       }
    //
    //       // is session deletable ? YES delete,  NO return with errors
    //       if ($canDelete == 1) {
    //         $old_query = Sessions::where('coach_id', $request->coach_id)
    //           ->whereBetween('start_datetime', [$start_datetime, $end_datetime])->delete();
    //       } else {
    //         return redirect()->route('Calendario.index')->withErrors($errorMsg, 'addsessionForm')->withInput();
    //       }
    //     }
    //
    //     if(Session('role') == 4) {
    //       $status = 5;
    //     } else {
    //       $status = 0;
    //     }
    //
    //     //save the session
    //     $session = new Sessions();
    //     $session->name = $request->name;
    //     $session->description = $request->description;
    //     $session->coach_id = $request->coach_id;
    //     $session->coachee_id = $_POST['hidden-coachee_id'];
    //     $session->status = $status;
    //     $session->origin_type = $status;
    //     $session->start_datetime = $start_datetime;
    //     $session->end_datetime = $end_datetime;
    //     $session->save();
    //
    //     // return redirect()->route('Calendario.index');
    //     return redirect()->back()->with([
    //         'status' => 'Se cre?? la sesi??n exitosamente'
    //     ]);
    // }
    //
    // //  generates a list of avalible in a range between start_date and end_date
    // public function config(Request $request)
    // {
    //     //this functino only aplies to coaches ( 5 role )
    //     //Validate the form
    //     $validator = Validator::make($request->all(),[
    //         'name' => 'required|min:3|max:191',
    //         'description' => 'required',
    //         'start_date' => 'required|date_format:"Y-m-d"|after:"2015-01-01"',
    //         'end_date' => 'required|date_format:"Y-m-d"|after:start_date',
    //         'start_time' => 'required|date_format:"H:i"',
    //         'end_time' => 'required|date_format:"H:i"|after:start_time',
    //         'w_days' => 'required'
    //     ]);
    //
    //     if( $validator->fails() )
    //     {
    //         return redirect()->route('Calendario.index')->withErrors($validator, 'mainForm')
    //           ->with('type', 'config')->with('session_id',0)->withInput();
    //     }
    //
    //     // get selected week days and put them in string
    //     $w_days = '0000000';
    //     for ($x=0; $x < count($_POST['w_days']); $x++) {
    //       $w_days[ ($_POST['w_days'][$x]) ] = 1;
    //     }
    //
    //     //check if there is an old register from this coach
    //     $coach_config = Coach_config::where('coach_id', Session('user')->id)->get();
    //
    //     if( count($coach_config) > 0 ){      //update
    //       $query = Coach_config::where('coach_id', '=', Session('user')->id)->update([
    //           'start_date' => $_POST['start_date'],  'end_date' => $_POST['end_date'],
    //           'start_time' =>  $_POST['start_time'], 'end_time' => $_POST['end_time'],
    //           'w_days' => $w_days
    //       ]);
    //     } else {        //create
    //       $query = Coach_config::create([
    //           'coach_id' =>  Session('user')->id,
    //           'start_date' => $_POST['start_date'],  'end_date' => $_POST['end_date'],
    //           'start_time' =>  $_POST['start_time'], 'end_time' => $_POST['end_time'],
    //           'w_days' => $w_days
    //       ]);
    //     }
    //
    //     //delete previous sessions if there is an old config
    //     Sessions::where('coach_id',  Session('user')->id)->where('status', 5)
    //       ->where('origin_type', 1)->delete();
    //
    //     //save each individual session;
    //     $start_date = new \DateTime(  $_POST['start_date'].$_POST['start_time'] );
    //     $end_date = new \DateTime(  $_POST['end_date'].$_POST['end_time'] );
    //     // $end_date->modify('+1 day');
    //     $date_interval = new \DatePeriod(
    //        $start_date,
    //        new \DateInterval('P1D'),
    //        $end_date
    //     );
    //
    //     $start_time = strtotime($_POST['start_time']);
    //     $end_time = strtotime($_POST['end_time']);
    //
    //     $timePeriods = round(abs($start_time - $end_time) / 1800,2);
    //
    //     $period = [];
    //     foreach($date_interval as $date){
    //       if( $w_days[ date('w', strtotime( $date->format("Y-m-d") )) ] == 1){
    //         // $period[] = $date->format("Y-m-d");
    //         for ($x=1; $x <= $timePeriods; $x++) {
    //           $sesionStartDate = $date->format("Y-m-d H:i:s");
    //           $sesionEndDate = $date->modify('+30 minutes');
    //
    //           $session = new Sessions();
    //           $session->name = $_POST['name'];
    //           $session->description = $_POST['description'];
    //           $session->coach_id = Session('user')->id;
    //           $session->coachee_id = 0;
    //           $session->status = 5;
    //           $session->start_datetime = $sesionStartDate;
    //           $session->end_datetime = $sesionEndDate;
    //           $session->origin_type = 1;
    //           $session->save();
    //         }
    //       }
    //     }
    //
    //     //get all session from this coach, where status != 5
    //     $actives = Sessions::where('coach_id',  Session('user')->id)->where('status', '!=', 5)->get();
    //
    //     //for each register delete where stat == 5 and origin == 1  and start_datetime
    //     //between register.start_date and register.end_date
    //     for ($x=0; $x < count($actives); $x++) {
    //       //get range of dates
    //       $start_datetime = new \DateTime( $actives[$x]['start_datetime'] );
    //       $end_datetime = new \DateTime( $actives[$x]['end_datetime'] );
    //
    //       echo $actives[$x]['id'].' - start: '. $actives[$x]['start_datetime'] .' - end: '. $actives[$x]['end_datetime'] .'<br><br>';
    //
    //       Sessions::where('coach_id', Session('user')->id)
    //             ->where('status', 5)
    //             ->whereBetween('start_datetime', [$start_datetime, $end_datetime])
    //             ->delete();
    //     }
    //
    //     return redirect()->back()->with([
    //         'status' => 'Se crearon las sesiones exitosamente'
    //     ]);
    //     // return redirect()->route('Calendario.index');
    // }
    //
    // //  edit data from a session
    // public function edit(Request $request)
    // {
    //     //validate
    //     $validator = Validator::make($request->all(),[
    //         'name' => 'required|max:255',
    //         'description' => 'required|max:255',
    //         'coach_id' => 'required|max:255',
    //         'start_datetime' => 'required|max:255|date_format:"Y-m-d H:i:s"|after:"'.date('Y-m-d').'"'
    //     ]);
    //
    //     if( $validator->fails() )
    //     {
    //         return redirect()->route('Calendario.index')->withErrors($validator, 'mainForm')
    //           ->with('type', 'coach_edit')->with('session_id', $_POST['hidden-session-id'])->withInput();
    //     }
    //
    //     $start_datetime = new \DateTime( substr( $_POST['start_datetime'], 0, 16 ) );
    //
    //     //get data of the old session
    //     $old_session= Sessions::where('id', $_POST['hidden-session-id'])->first();
    //
    //     //if start_datetime has changed, do something, else just update   -   this aply when coach re-schedule the sesssion
    //     if( (substr( $_POST['start_datetime'], 0, 16 )).':00' != $old_session['start_datetime'] )
    //     {
    //         $start_testTime = new \DateTime( substr( $_POST['start_datetime'], 0, 16 ) );
    //         $start_testTime = $start_testTime->modify('-1 minutes');
    //         $end_datetime = new \DateTime( substr( $_POST['start_datetime'], 0, 16 ) );
    //         $end_datetime = $end_datetime->modify('+29 minutes');
    //         // $end_test_datetime = new \DateTime( substr( $_POST['start_datetime'], 0, 15 ) );
    //         // $end_test_datetime = $end_datetime->modify('+29 minutes');
    //
    //         // Get session between the new session's date
    //         $test_date = Sessions::where('coach_id', $request->coach_id)
    //           ->whereBetween('start_datetime', [$start_testTime, $end_datetime])->get();
    //
    //           // print_r( json_encode($test_date) );
    //
    //         // test if any test_date is deletable, if no -> return error, else (yes) delete update_test date
    //         if ( count($test_date) != 0 )
    //         {
    //             for ($x=0; $x < count($test_date); $x++) {
    //               $canDelete = 1;
    //               if ( $test_date[$x]['status'] != 5 && $test_date[$x]['status'] != 2 ) {
    //                 $canDelete = 0;
    //                 $errorMsg = 'No se puede sobreescribir la sesi??n del '.$test_date[$x]['start_datetime'];
    //                 break;
    //               }
    //             }
    //
    //             // is session deletable ? YES delete,  NO return with errors
    //             if ($canDelete == 1) {
    //               for ($x=0; $x < count($test_date); $x++) {
    //                 if( $test_date[$x]['status'] != 2 ){
    //                   $query = Sessions::where('id', $test_date[$x]['id'])->delete();
    //                 }
    //               }
    //             } else {
    //               return redirect()->route('Calendario.index')->withErrors($errorMsg, 'mainForm')
    //                 ->with('type', 'coach_edit')->with('session_id', $_POST['hidden-session-id'])->withInput();
    //             }
    //
    //         }
    //
    //         //create new session
    //         $session = new Sessions();
    //         $session->name = $_POST['name'];
    //         $session->description = $_POST['description'];
    //         $session->coach_id = $_POST['coach_id'];
    //         $session->coachee_id = 0;
    //         $session->status = 5;
    //         $session->origin_type = 2;
    //         $session->start_datetime = $start_datetime;
    //         $session->end_datetime = $end_datetime;
    //         $session->save();
    //
    //         // ------------- //update (clear the old session)
    //         // $update_old = Sessions::where('id', $_POST['hidden-session-id'])->update([
    //         //   'coachee_id' => 0,  'status' => 5, 'first_session' => 0
    //         // ]);
    //
    //         // DELETE (clear the old session)
    //         $update_old = Sessions::where('id', $_POST['hidden-session-id'])->delete();
    //     }
    //     else
    //     {          //just update register
    //
    //         if( Session('role') == 5 || Session('role') == 6 ){
    //           $sesionStatus = 0;
    //         } else {
    //           $sesionStatus = 5;
    //         }
    //
    //         Sessions::where('id', $_POST['hidden-session-id'])->update([
    //           'name' => $_POST['name'], 'description' => $_POST['description'],
    //           'coach_id' => $_POST['coach_id'], 'coachee_id' => $_POST['hidden-coachee_id'],
    //           'status' => $sesionStatus
    //         ]);
    //     }
    //
    //     return redirect()->back()->with([
    //         'status' => 'Se modific?? la sesi??n exitosamente'
    //     ]);
    // }
    //
    // //  change the status of a session
    // public function editStatus(Request $request)
    // {
    //   // print_r( json_encode($_POST) );
    //   // echo '<br><br>';
    //
    //   switch ( $_POST['hidden-type'] ) {
    //     case 'client_schedule':
    //           //validate data
    //           $validator = Validator::make($request->all(),[
    //               'start_datetime' => 'required|max:255|date_format:"Y-m-d H:i:s"|after:"'.date('Y-m-d').'"',
    //           ]);
    //
    //           if( $validator->fails() )
    //           {
    //               return redirect()->route('Calendario.index')->withErrors($validator, 'mainForm')
    //                 ->with('type', 'client_schedule')->with('session_id',0)->withInput();
    //           }
    //
    //           //get data from selected session
    //           $selected_session = Sessions::where('id', $_POST['hidden-session-id'])->first();
    //
    //           if( $selected_session == null || $selected_session['status'] != 5)
    //           {
    //               return redirect()->route('Calendario.index')->withErrors('La sessi??n seleccionada caduc??', 'mainForm')
    //                 ->with('type', 'client_schedule')->with('session_id',0)->withInput();
    //           }
    //
    //           //get if this is the first session of this coachee, set the duration for the session
    //           $first_session = Sessions::where('coachee_id', $_POST['hidden-coachee_id'])->where('status', '!=', 2)->get();
    //           $duration = ((count($first_session) == 0)? '90 minutes' : '60 minutes');
    //           $bool_first_session = ((count($first_session) == 0)? 1 : 0);
    //           //check if the acepted session can be shcheduled whit this duration time
    //           $selected_session_start_datetime = \DateTime::createFromFormat('Y-m-d H:i:s', $selected_session['start_datetime']);
    //           $selected_session_end_datetime = \DateTime::createFromFormat('Y-m-d H:i:s', $selected_session['start_datetime']);
    //           $selected_session_end_datetime = $selected_session_end_datetime->modify('+'.$duration);
    //
    //           //test Sessions between the range of duration
    //           $between_duration_range_sessions = Sessions::where('id', '!=', $_POST['hidden-session-id'])
    //               ->where('coach_id', $selected_session['coach_id'])
    //               ->whereBetween('start_datetime', [ $selected_session_start_datetime->format('Y-m-d H:i:s'), $selected_session_end_datetime->format('Y-m-d H:i:s') ])
    //               ->get();
    //           $isDeletable = 1;
    //           for ($x=0; $x < count($between_duration_range_sessions); $x++) {
    //             if( $between_duration_range_sessions[$x]['status'] != 5 && $between_duration_range_sessions[$x]['status'] != 2 ){
    //               $isDeletable = 0;
    //               $errorMsg = 'No se puedo agendar esta cita, el horario de la '.substr($between_duration_range_sessions[$x]['start_datetime'], 11, 5). ' ya se encuentra ocupado';
    //               break;
    //             }
    //           }
    //
    //           //if there's a non deletable session, return error
    //           if($isDeletable == 0){
    //             return redirect()->route('Calendario.index')->withErrors($errorMsg, 'mainForm')
    //                ->with('type', 'client_schedule')->with('session_id', $_POST['hidden-session-id'])->withInput();
    //           }
    //           else {
    //               //if status is != canceled hide all avalible session
    //               for ($x=0; $x < count($between_duration_range_sessions); $x++) {
    //                 if ($between_duration_range_sessions[$x]['status'] != 2 && $between_duration_range_sessions[$x]['start_datetime'] != $selected_session_end_datetime->format('Y-m-d H:i:s') ) {
    //                   $query = Sessions::where('id', $between_duration_range_sessions[$x]['id'])->update(['status'=>6]);
    //                 }
    //               }
    //               // update selected session status
    //               $query = Sessions::where('id', $_POST['hidden-session-id'])
    //                   ->update([
    //                       'status'=>0,
    //                       'end_datetime'=>$selected_session_end_datetime,
    //                       'coachee_id' => $_POST['hidden-coachee_id'],
    //                       'first_session' => $bool_first_session
    //               ]);
    //
    //               //hide 30 minutes session before the new session if exists
    //               $before_session_datetime = \DateTime::createFromFormat('Y-m-d H:i:s', $selected_session['start_datetime']);
    //               $before_session_datetime = $before_session_datetime->modify('- 30 minutes');
    //               $before_session = Sessions::where('coach_id', $selected_session['coach_id'])
    //                 ->where( 'start_datetime', $before_session_datetime->format('Y-m-d H:i:s') )->first();
    //
    //               // print_r( json_encode($before_session) );
    //               if ($before_session != null){
    //                 if($before_session['status'] == 5){
    //                   $query = Sessions::where('id', $before_session['id'])
    //                       ->update([
    //                           'status'=>6
    //                   ]);
    //                 }
    //               }
    //           }
    //
    //           return redirect()->back()->with([
    //               'status' => 'Se agend?? la sesi??n exitosamente, espera la confirmaci??n del coach'
    //           ]);
    //     break;
    //
    //     case 'coach_hide':
    //             //hide selected session
    //             $query = Sessions::where('id', $_POST['hidden-session-id'])->update(['status'=>6]);
    //             return redirect()->back()->with([
    //                 'status' => 'Se ocult?? la sesi??n exitosamente'
    //             ]);
    //     break;
    //
    //     case 'cancel_session':
    //           $selected_session = Sessions::where('id', $_POST['hidden-session-id'])->first();
    //           // print_r($selected_session);
    //
    //           if($selected_session['status'] == 2){
    //             return redirect()->route('Calendario.index')->withErrors('La sessi??n ya ha sido cancelada anteriormente', 'mainForm')
    //               ->with('type', 'show_info')->with('session_id',  $_POST['hidden-session-id'])->withInput();
    //           }
    //
    //           // reactivate session hidden by the selected session
    //           //get the duration of the session
    //           $from_time = strtotime($_POST['start_datetime']);
    //           $to_time = strtotime($_POST['end_datetime']);
    //           $minutes = round(abs($to_time - $from_time) / 60,2). " minute";
    //
    //           //get sessions between start and end of datetime
    //           $between_dates = Sessions::where('coach_id', $_POST['coach_id'])
    //           ->whereBetween('start_datetime', [ $_POST['start_datetime'], $_POST['end_datetime'] ])
    //           ->get();
    //
    //           //update hidden sessions status to avalible
    //           for ($x=0; $x < count($between_dates); $x++) {
    //             if($between_dates[$x]['status'] == 6 && $between_dates[$x]['start_datetime'] != $_POST['end_datetime']){
    //               $query = Sessions::where('id', $between_dates[$x]['id'])->update(['status'=>5]);
    //             }
    //           }
    //
    //           //update before selected session status
    //           $before_start_date = \DateTime::createFromFormat('Y-m-d H:i:s', $_POST['start_datetime']);
    //           $before_start_date = $before_start_date->modify('-30 minutes');
    //           $before_session = Sessions::where('start_datetime', $before_start_date)->where('status', 6)->first();
    //           if($before_session != null || $before_session['status'] == 6){
    //             $query = Sessions::where('id', $before_session['id'])->update(['status' => 5]);
    //           }
    //
    //           switch ($selected_session['status']) {
    //             case 0:       $subStatus = 'Agendado por el cliente';    break;
    //             case 1:       $subStatus = 'Aceptado por el coach';      break;
    //             case 2:       $subStatus = 'Cancelado';                  break;
    //             case 3:       $subStatus = 'Sesi??n atendida';            break;
    //             case 4:       $subStatus = 'Sesi??n no atendida';         break;
    //             case 5:       $subStatus = 'Disponible';                 break;
    //             case 6:       $subStatus = 'Oculto';                     break;
    //           }
    //
    //           $subMsg = ' -- Sesi??n cancelada por el '.((Session('role') == 4)? 'coach' : 'cliente').' '.Session('user')->name.' '.Session('user')->last_name.' -- ??ltimo status: '.$subStatus;
    //           $selected_session['description'] .= $subMsg;
    //
    //           echo $selected_session['description'];
    //
    //           echo $_POST['hidden-session-id'];
    //           // cancel the selected session
    //           $query = Sessions::where('id', $_POST['hidden-session-id'])
    //               ->update([
    //                   'status' => 2,
    //                   'description' => $selected_session['description']
    //                 ]);
    //
    //           return redirect()->back()->with([
    //               'status' => 'La sesi??n se cancel?? exitosamente'
    //           ]);
    //     break;
    //
    //     case 'coach_unhide':
    //           //un-hide session
    //           $query = Sessions::where('id', $_POST['hidden-session-id'])->update([ 'status' => 5 ]);
    //
    //           return redirect()->back()->with([
    //               'status' => 'Se rehabilit?? la sesi??n exitosamente'
    //           ]);
    //     break;
    //
    //     case 'coach_acept':
    //             //acept selected session
    //             $query = Sessions::where('id', $_POST['hidden-session-id'])->update(['status'=>1]);
    //
    //             //get acepted session data
    //             $sesion = Sessions::where('id', $_POST['hidden-session-id'])->first();
    //
    //             //search for link between coachee & coach
    //             $search = UsersXcoaches::where( 'id_user', $sesion['coachee_id'] )->where( 'id_coach', $sesion['coach_id'] )->get();
    //
    //             //is !isset, create, else update status 'active'
    //             if( count($search) > 0 ) {
    //               $action = UsersXcoaches::where( 'id_user', $sesion['coachee_id'] )->where( 'id_coach', $sesion['coach_id'] )->update(['active' => 1]);
    //             } else {
    //               $action = UsersXcoaches::insert([
    //                                           'id_user' => $sesion['coachee_id'],
    //                                           'id_coach' => $sesion['coach_id'],
    //                                           'active' => 1
    //                                       ]);
    //             }
    //
    //             return redirect()->back()->with([
    //                 'status' => 'Se acept?? la sesi??n exitosamente'
    //             ]);
    //     break;
    //
    //     default:
    //       // code...
    //     break;
    //   }
    // }
    //
    //
    //
    // //  return counter with las session info or redirect to pay
    // public function main_view()
    // {
    //   date_default_timezone_set('America/Mexico_City');
    //
    //   // test if is coach or coachee
    //   $user_type = ( ( Session('role') == 4 )? 'coach_id' : 'coachee_id' );
    //   // get las session
    //   $today = date('Y-m-d H:i:s');
    //   $today = date('Y-m-d H:i:s',strtotime('-1 hour',strtotime($today)));      //date -1, to fin current sessions
    //
    //   $sessions = Sessions::where( $user_type,  Session('user')->id )
    //             ->where(function($query){
    //               $query->where('status', '=', 1)
    //               ->orWhere('status', '>=', 8);
    //             })
    //             ->where('start_datetime', '>=', $today )
    //             ->orderBy('start_datetime')->first();
    //   // get the list of avalible tokens for the user
    //   $tokens = Tokens::where('user_id', Session('user')->id)->where('status', 0)->get();
    //
    //   $section = null;
    //   foreach(Session('menu_info') as $group){
    //       foreach($group->permissions as $menu_item){
    //           if($menu_item->id == 4){ // coaching sessions permission id is 2
    //               $section = $menu_item;
    //               break;
    //           }
    //       }
    //   }
    //
    //   return view('sessions.main')->with([ 'section' => $section,  'sessionList' => $sessions, 'tokenList' => $tokens ]);
    // }
    //
    // //  return call view
    // public function call_view(){
    //   return view('sessions.call_view');
    // }

}
