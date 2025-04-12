<?php

namespace App\Http\Controllers;

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

        $salaries = DB::table('month_closings')
            -> join('employees' , 'employees.id' , '=' , 'month_closings.user_id')
            -> select('month_closings.*' , 'employees.name as employee_name' )
            -> whereMonth('month_closings.date', '=', $month)
            -> whereYear('month_closings.date', '=',  $year)
            -> get();
        if(count($salaries) > 0){
            $isSalary = 1 ;
        } else {
            $isSalary = 0 ;
        }

        $attends = DB::table('attends')
            -> join('employees' , 'employees.id' , '=' , 'attends.user_id')
            -> select('attends.*' , 'employees.name as employee_name' , 'employees.tag as tag' )
            -> whereMonth('attends.date', '=', $month)
            -> whereYear('attends.date', '=',  $year)
            -> get();

       return view('month-close.index' , compact('employees' , 'isSalary' , 'attends' , 'salaries'));
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
