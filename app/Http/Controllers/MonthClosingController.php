<?php

namespace App\Http\Controllers;

use App\Models\DeductionAndBonse;
use App\Models\Employee;
use App\Models\MonthClosing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class MonthClosingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {


        $employees = Employee::all();

        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $isSalary = 0 ;


        $date = $month < 9 ? "0" . $month : $month . "-". $year;

        $salaries = DB::table('month_closings')
            -> join('employees' , 'employees.id' , '=' , 'month_closings.user_id')
            -> select('month_closings.*' , 'employees.name as employee_name' )
            -> whereMonth('month_closings.date', '=', $month)
            -> whereYear('month_closings.date', '=',  $year)
            -> get();
        if(count($salaries) > 0){
            $isSalary = 1 ;
            return view('month-close.index' , compact('employees' , 'isSalary' , 'salaries' , 'date'));

        } else {
            $isSalary = 0 ;
            $advances = 0 ;
            $multiplier = Carbon::create($year, $month, 1)->daysInMonth;
            $deductionsSubquery = DB::table('deduction_and_bonses')
                ->select(
                    'user_id',
                    DB::raw("SUM(CASE WHEN type = 0 THEN hours ELSE 0 END) as deductions_hour"),
                    DB::raw("SUM(CASE WHEN type = 1 THEN hours ELSE 0 END) as reward_hour"),
                )
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->groupBy('user_id');

            $moneyDeductionsSubquery = DB::table('rewards')
                ->select(
                    'user_id',
                    DB::raw("SUM(CASE WHEN type = 0 THEN reward ELSE 0 END) as deductions_money"),
                    DB::raw("SUM(CASE WHEN type = 1 THEN reward ELSE 0 END) as reward_money"),
                )
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->groupBy('user_id');

            $attends = DB::table('attends')
                ->join('employees', 'employees.id', '=', 'attends.user_id')
                ->leftJoinSub($deductionsSubquery, 'deductions', function ($join) {
                    $join->on('employees.id', '=', 'deductions.user_id');
                })
                ->leftJoinSub($moneyDeductionsSubquery, 'moneyDeductions', function ($join) {
                    $join->on('employees.id', '=', 'moneyDeductions.user_id');
                })
                ->select(
                    'employees.name as employee_name',
                    'employees.tag as tag',
                    DB::raw("SUM(CASE WHEN attends.absent = 'true' THEN 1 ELSE 0 END) as absent"),
                    DB::raw("SUM(CASE WHEN attends.absent != 'true' THEN 1 ELSE 0 END) as present"),
                    DB::raw("employees.workHoursCount * $multiplier as required_hours"),
                    DB::raw("CONCAT(FLOOR(SUM(TIME_TO_SEC(STR_TO_DATE(workTime, '%H:%i')))/3600), ':', LPAD(FLOOR((SUM(TIME_TO_SEC(STR_TO_DATE(workTime, '%H:%i'))) % 3600) / 60), 2, '0') ) as total_worked_time"),
                    DB::raw("CONCAT(FLOOR(SUM(TIME_TO_SEC(STR_TO_DATE(late, '%H:%i')) / 60) / 60), ':', LPAD(FLOOR(SUM(TIME_TO_SEC(STR_TO_DATE(late, '%H:%i')) / 60) % 60), 2, '0')) as late_hours"),
                    DB::raw("CONCAT(FLOOR(SUM(TIME_TO_SEC(STR_TO_DATE(workTimeAdd, '%H:%i')) / 60) / 60), ':', LPAD(FLOOR(SUM(TIME_TO_SEC(STR_TO_DATE(workTimeAdd, '%H:%i')) / 60) % 60), 2, '0')) as added_hours"),
                    DB::raw("CONCAT(FLOOR(SUM(TIME_TO_SEC(STR_TO_DATE(workTime, '%H:%i')) / 60) / 60), ':', LPAD(FLOOR(SUM(TIME_TO_SEC(STR_TO_DATE(workTime, '%H:%i')) / 60) % 60), 2, '0')) as actual_hours"),
                    DB::raw("((employees.salary / employees.workHoursCount) / $multiplier) as hour_price"),
                    DB::raw("CONCAT(FLOOR(COALESCE(deductions.deductions_hour, 0)), ':', LPAD(ROUND((COALESCE(deductions.deductions_hour, 0) - FLOOR(COALESCE(deductions.deductions_hour, 0))) * 60), 2, '0') ) as deductions_hour"),
                    DB::raw("COALESCE(deductions.reward_hour, 0) as reward_hour"),
                    DB::raw("COALESCE(moneyDeductions.deductions_money, 0) as deductions_money"),
                    DB::raw("COALESCE(moneyDeductions.reward_money, 0) as reward_money"),
                    DB::raw("$advances as advances"),
                    DB::raw("CONCAT(
                        FLOOR((
                            SUM(TIME_TO_SEC(STR_TO_DATE(workTime, '%H:%i')) / 60) +
                            SUM(TIME_TO_SEC(STR_TO_DATE(workTimeAdd, '%H:%i')) / 60) +
                            COALESCE(deductions.reward_hour, 0) * 60 -
                            COALESCE(deductions.deductions_hour, 0) * 60 -
                            SUM(TIME_TO_SEC(STR_TO_DATE(late, '%H:%i')) / 60)
                        ) / 60), ':',
                        LPAD((
                            SUM(TIME_TO_SEC(STR_TO_DATE(workTime, '%H:%i')) / 60) +
                            SUM(TIME_TO_SEC(STR_TO_DATE(workTimeAdd, '%H:%i')) / 60) +
                            COALESCE(deductions.reward_hour, 0) * 60 -
                            COALESCE(deductions.deductions_hour, 0) * 60 -
                            SUM(TIME_TO_SEC(STR_TO_DATE(late, '%H:%i')) / 60)
                        ) % 60, 2, '0')
                    ) as net_time")

                )
                ->whereMonth('attends.date', $month)
                ->whereYear('attends.date', $year)
                ->groupBy('employees.id', 'employees.name', 'employees.tag', 'employees.workHoursCount', 'employees.salary', 'deductions.deductions_hour')
                ->get();


            //netTime = WorkTime + WorkTimeAdd + HourBonse - HourDeduction - PenaltyLate;

          //  return $attends ;
            return view('month-close.index' , compact('employees' , 'isSalary' , 'attends' , 'date' ));

        }



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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MonthClosing  $monthClosing
     * @return \Illuminate\Http\Response
     */
    public function show(MonthClosing $monthClosing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MonthClosing  $monthClosing
     * @return \Illuminate\Http\Response
     */
    public function edit(MonthClosing $monthClosing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MonthClosing  $monthClosing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MonthClosing $monthClosing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MonthClosing  $monthClosing
     * @return \Illuminate\Http\Response
     */
    public function destroy(MonthClosing $monthClosing)
    {
        //
    }
}
