<?php

namespace App\Http\Controllers;

use App\Models\Attend;
use App\Models\Employee;
use App\Models\HrSettings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $month = Carbon::now()->month;
            $year = Carbon::now()->year;

        $attends = DB::table('attends')
            -> join('employees' , 'employees.id' , '=' , 'attends.user_id')
            -> select('attends.*' , 'employees.name as employee_name' )
            -> whereMonth('attends.date', '=', $month)
            -> whereYear('attends.date', '=',  $year)
            -> get();

        $employees = Employee::all();

            return view('attend.index', compact('attends' , 'employees'));

    }

    public function getAttendAjax($month , $year , $user_id)
    {
        $attends = DB::table('attends')
            -> join('employees' , 'employees.id' , '=' , 'attends.user_id')
            -> select('attends.*' , 'employees.name as employee_name' )
            -> whereMonth('attends.date', '=', $month)
            -> whereYear('attends.date', '=',  $year);
        if($user_id > 0){
            $attends = $attends->where('attends.user_id' , '=' , $user_id) -> get();
        } else {
            $attends = $attends -> get();
        }
        echo json_encode($attends);
        exit;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request -> id == 0){

            if(Carbon::parse($request -> on_duty) <= Carbon::parse($request -> clock_in)){

                $time1 = Carbon::parse($request -> clock_in);
                $time2 = Carbon::parse($request -> on_duty);

                $diffInMinutes = $time1->diffInMinutes($time2);

                $hours = floor($diffInMinutes / 60);
                $minutes = $diffInMinutes % 60;

                if($hours < 10) $hours = '0'.$hours;
                if($minutes < 10) $minutes = '0'.$minutes;

                $late =  $hours . ':' . $minutes ;


            } else {
                $late = "00:00" ;
            }



            if(Carbon::parse($request -> clock_out) <= Carbon::parse($request -> off_duty)){

                $time1 = Carbon::parse($request -> clock_out);
                $time2 = Carbon::parse($request -> off_duty);

                $diffInMinutes = $time1->diffInMinutes($time2);

                $hours = floor($diffInMinutes / 60);
                $minutes = $diffInMinutes % 60;

                if($hours < 10) $hours = '0'.$hours;
                if($minutes < 10) $minutes = '0'.$minutes;

                $early =  $hours . ':' . $minutes ;



            } else {
                $early = "00:00" ;
            }

            if(Carbon::parse($request -> off_duty) < Carbon::parse($request -> clock_out)){


                $time1 = Carbon::parse($request -> clock_out);
                $time2 = Carbon::parse($request -> off_duty);

                $diffInMinutes = $time1->diffInMinutes($time2);

                $hours = floor($diffInMinutes / 60);
                $minutes = $diffInMinutes % 60;

                if($hours < 10) $hours = '0'.$hours;
                if($minutes < 10) $minutes = '0'.$minutes;

                $workAdded =  $hours . ':' . $minutes ;

            } else {
                $workAdded = "00:00" ;
            }

            $time1 = Carbon::parse($request -> clock_out);
            $time2 = Carbon::parse($request -> clock_in);
            $diffInMinutes = $time1->diffInMinutes($time2);

            $hours = floor($diffInMinutes / 60);
            $minutes = $diffInMinutes % 60;

            if($hours < 10) $hours = '0'.$hours;
            if($minutes < 10) $minutes = '0'.$minutes;

            $workTime =  $hours . ':' . $minutes ;


            $penalty = $late;

//             $settings = HrSettings::all() -> first();
//             if($settings ){
//                 if($late >  $settings -> allowLate){
//                     $penalty = $settings -> allowLate + (($late - $settings -> allowLate) * 2 ) ;
//
//                 } else {
//                     $penalty = $late;
//                 }
//
//             }else {
//                 $penalty = "00:00" ;
//             }

            Attend::create([
                'user_id' => $request -> user_id,
                'date' => Carbon::parse($request -> date),
                'on_duty' => $request -> on_duty,
                'off_duty' => $request -> off_duty,
                'clock_in' => $request -> clock_in,
                'clock_out' => $request -> clock_out,
                'late' => $late ,
                'early' => $early,
                'absent' => 0,
                'workTimeAdd' => $workAdded,
                'workTime' => $workTime,
                'workTimeLate' => $late,
                'penaltyLate' => $penalty,
                'user_ins' => Auth::user() -> id,
                'user_upd' => 0
            ]);
            return redirect()->route('attend')->with('success' ,  __('main.saved'));
        } else {
            return  $this -> update($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attend = Attend::find($id);
      echo  json_encode($attend);
        exit();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function edit(Attend $attend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $attend = Attend::find($request -> id);
        if($attend){

            if(Carbon::parse($request -> on_duty) <= Carbon::parse($request -> clock_in)){

                $time1 = Carbon::parse($request -> clock_in);
                $time2 = Carbon::parse($request -> on_duty);

                $diffInMinutes = $time1->diffInMinutes($time2);

                $hours = floor($diffInMinutes / 60);
                $minutes = $diffInMinutes % 60;

                if($hours < 10) $hours = '0'.$hours;
                if($minutes < 10) $minutes = '0'.$minutes;

                $late =  $hours . ':' . $minutes ;


            } else {
                $late = "00:00" ;
            }



            if(Carbon::parse($request -> clock_out) <= Carbon::parse($request -> off_duty)){

                $time1 = Carbon::parse($request -> clock_out);
                $time2 = Carbon::parse($request -> off_duty);

                $diffInMinutes = $time1->diffInMinutes($time2);

                $hours = floor($diffInMinutes / 60);
                $minutes = $diffInMinutes % 60;

                if($hours < 10) $hours = '0'.$hours;
                if($minutes < 10) $minutes = '0'.$minutes;

                $early =  $hours . ':' . $minutes ;



            } else {
                $early = "00:00" ;
            }

            if(Carbon::parse($request -> off_duty) < Carbon::parse($request -> clock_out)){


                $time1 = Carbon::parse($request -> clock_out);
                $time2 = Carbon::parse($request -> off_duty);

                $diffInMinutes = $time1->diffInMinutes($time2);

                $hours = floor($diffInMinutes / 60);
                $minutes = $diffInMinutes % 60;

                if($hours < 10) $hours = '0'.$hours;
                if($minutes < 10) $minutes = '0'.$minutes;

                $workAdded =  $hours . ':' . $minutes ;

            } else {
                $workAdded = "00:00" ;
            }

            $time1 = Carbon::parse($request -> clock_out);
            $time2 = Carbon::parse($request -> clock_in);
            $diffInMinutes = $time1->diffInMinutes($time2);

            $hours = floor($diffInMinutes / 60);
            $minutes = $diffInMinutes % 60;

            if($hours < 10) $hours = '0'.$hours;
            if($minutes < 10) $minutes = '0'.$minutes;

            $workTime =  $hours . ':' . $minutes ;


            $penalty = $late;



            $attend -> update([
                'user_id' => $request -> user_id,
                'date' => Carbon::parse($request -> date),
                'on_duty' => $request -> on_duty,
                'off_duty' => $request -> off_duty,
                'clock_in' => $request -> clock_in,
                'clock_out' => $request -> clock_out,
                'late' => $late ,
                'early' => $early,
                'absent' => 0,
                'workTimeAdd' => $workAdded,
                'workTime' => $workTime,
                'workTimeLate' => $late,
                'penaltyLate' => $penalty,
                'user_upd' => Auth::user() -> id
            ]);

            return redirect()->route('attend')->with('success' ,  __('main.updated'));

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attend $attend)
    {
        //
    }
}
