<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Sessions;
use App\User;
use App\UserVision;
use App\UserGoals;
use Validator;

class GoalController extends Controller
{
    public $sectionNumber = 3;
    /** Finds the newxt weekly Period
     *@return the date of the next weekly period
     */
    public function getNextWeekMonth(){
        $today = date("Y-m-d");
        $dayOfTheWeek = date("N", strtotime($today));
        $nextWeekend = date('Y-m-d', strtotime($today. ' + 5 days'));
        return $nextWeekend;
    }
    /** Fetches the weeklygoals of a user and sorts them in arrays by each week
     *@param user_id The user id
     *@return the array with the weekly goals
     */
    public function getGoalsByWeek($user_id){
        $returnArray = [];
        $goalsWeekly = UserGoals::where('user_id','=',Session('user')->id)->where('type', '=', 1)->orderBy('date', 'desc')->get();
        $currentArray = [];
        $currentDate = null;
        $fistPeriod = null;
        $nextPeriod = $this->getNextWeekMonth();
        for($i = 0; $i < sizeof($goalsWeekly);$i++){
            if($fistPeriod == null){
                $fistPeriod = $goalsWeekly[$i]->date;
            }
            if($currentDate == null){
                $currentDate = $goalsWeekly[$i]->date;
            }else if($goalsWeekly[$i]->date != $currentDate){
                array_push($returnArray, $currentArray);
                $currentDate = null;
                $currentArray = [];
            }
            array_push($currentArray, $goalsWeekly[$i]);
        }
        if(sizeof($goalsWeekly) > 0){
            array_push($returnArray, $currentArray);
        }

        if($nextPeriod != $fistPeriod){
            array_unshift($returnArray, $nextPeriod);
        }
        return $returnArray;
    }
    /** Finds the newxt tri Month Period
     *@return the date of the next trimonth period
     */
    public function getNextTriMonth(){
        $today = date("Y-m-d");
        $month = date("m", strtotime($today));
        $year = date("Y", strtotime($today));
        if($month > 9){
            $month = 12;
        }else if($month > 6){
            $month = 9;
        }else if($month > 3){
            $month = 6;
        }else{
            $month = 3;
        }
        switch($month){
            case 3:
            case 12:
                $day = 31;
                break;
            case 6:
            case 9:
                $day = 30;
            default:
                $day = 30;
        }
        $time = strtotime($month.'/'.$day.'/'.$year);
        $newformat = date('Y-m-d',$time);
        return $newformat;
    }
    /** Fetches the 3 monthly goals of a user and sorts them in arrays by each 3 months
     *@param user_id The user id
     *@return the array with the 3 monthly goals
     */
    public function getGoalsByTriMonth($user_id){
        $returnArray = [];
        $goals3Monthly = UserGoals::where('user_id','=',Session('user')->id)->where('type', '=', 0)->orderBy('date', 'desc')->get();
        $currentArray = [];
        $currentDate = null;
        $fistPeriod = null;
        $nextPeriod = $this->getNextTriMonth();
        for($i = 0; $i < sizeof($goals3Monthly);$i++){
            if($fistPeriod == null){
                $fistPeriod = $goals3Monthly[$i]->date;
            }
            if($currentDate == null){
                $currentDate = $goals3Monthly[$i]->date;
            }else if($goals3Monthly[$i]->date != $currentDate){
                array_push($returnArray, $currentArray);
                $currentDate = null;
                $currentArray = [];
            }
            array_push($currentArray, $goals3Monthly[$i]);
        }
        if(sizeof($goals3Monthly) > 0){
            array_push($returnArray, $currentArray);
        }
        if($nextPeriod != $fistPeriod){
            array_unshift($returnArray, $nextPeriod);
        }
        return $returnArray;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coachesAvailable = null;
        $permission = DB::table('permission_role')
            ->where('role_id','=',Session('role'))
            ->where('permission_id','=',$this->sectionNumber)
            ->get();
        if(empty($permission)){
            return redirect()->route('home');
        }
        $vision = UserVision::where('user_id','=',Session('user')->id)->first();

        $weeklyGoals = $this->getGoalsByWeek(Session('user')->id);
        $trimonthlyGoals = $this->getGoalsByTriMonth(Session('user')->id);
        $section = null;
        foreach(Session('menu_info') as $group){
            foreach($group->permissions as $menu_item){
                if($menu_item->id == $this->sectionNumber){ // The Calendar permission id is 2
                    $section = $menu_item;
                    break;
                }
            }
        }
        return view('goal.index', [
            'section' => $section,
            'vision' => $vision,
            'weeklyGoals' => $weeklyGoals,
            'trimonthlyGoals' => $trimonthlyGoals
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateGoal(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'description' => 'max:255',
            'completed' => 'required',
            'type' => 'required',
            'date' => 'required|max:255|date_format:"Y-m-d"|after:"2015-01-01"'

        ]);
        $goal = null;
        if( $validator->fails() )
        {
           return response()->json(['status' => 404, 'msg' => $validator], 404);
        }

        if($request->input('description') == null && $request->input('id') != null){          //si descripcion es nulo y id no es nulo
            $query = DB::connection('mysql')->delete('
                        DELETE FROM saltum_db.user_goals
                        WHERE id = ?',[$request->input('id')]);
            $deleted = '1';
        } else if($request->input('description') != null) {   //si descripcion no es nulo
            $goalText = $request->input('description');
            $goal = UserGoals::firstOrNew(array('id' => $request->input('id')));
            $goal->user_id = Session('user')->id;
            $goal->description = $goalText;
            $goal->completed = $request->input('completed');
            $goal->type = $request->input('type');
            $goal->date = $request->input('date');
            $goal->save();
            $deleted = '0';
        }else{
            $deleted = '1';
        }

        if($goal === null){
            $id = null;
        }else{
            $id = $goal->id;
        }

        return response()->json(['status' => 200, 'deleted' => $deleted, "id" => $id], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateCompleted(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => 'max:255',
            'completed' => 'required'
        ]);
        $deleted = '0';
        if( $validator->fails() )
        {
           return response()->json(['status' => 404, 'msg' => $validator], 404);
        }

        $goal = UserGoals::firstOrNew(array('id' => $request->input('id')));
        $goal->user_id = Session('user')->id;
        $goal->completed = $request->input('completed');
        $goal->save();
        return response()->json(['status' => 200, 'deleted' => $deleted], 200);
    }
    /**
     * Updates the vision text of the session user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateVision(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'vision' => 'max:255'
        ]);

        if( $validator->fails() )
        {
           return response()->json(['status' => 404, 'msg' => 'Has excedido el tama??o del texto.'], 404);
        }

        if($request->input('vision') == null){
            $visionText = "";
        }else{
            $visionText = $request->input('vision');
        }

        $visionExists = DB::table('user_vision')
                            ->where('user_id', Session('user')->id)
                            ->first();

        if ($visionExists == null) {
          $query = DB::table('user_vision')->insert([
              'user_id' => Session('user')->id,
              'vision' => $visionText,
          ]);
        } else {
          $vision = DB::table('user_vision')
              ->where('user_id', Session('user')->id)
              ->update(['vision' => $visionText]);
        }



        return response()->json(['status' => 200, 'vision' => $visionText], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
      /*  Sessions::destroy(Input::get('uid'));
        return response()->json(['status' => 200], 200);*/
    }
}
