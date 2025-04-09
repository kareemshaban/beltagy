<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
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
        $employees = DB::table('employees') ->
        join('departments', 'departments.id', '=', 'employees.department_id') ->
            join('job', 'job.id', '=', 'employees.job_id')
            -> select('employees.*' , 'departments.name as department' , 'job.name as job') ->  get();

        $departments = Department::all();
        $jobs = Job::all();
        return view('Employee.index' , compact('employees' , 'departments' , 'jobs'));
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
            Employee::create([
                'name' => $request -> name,
                'phone' =>  $request -> phone ?? "",
                'address' => $request ->address ?? "" ,
                'salary' => $request -> salary ?? 0,
                'workHoursCount' => $request -> workHoursCount ?? 0,
                'workDaysCount' => $request -> workDaysCount ?? 0,
                'offWeaklyDay' => $request -> offWeaklyDay ?? 1,
                'tag' => $request -> tag ?? 0,
                'department_id' => $request -> department_id ?? 0 ,
                'job_id' => $request -> job_id  ?? 0,
                'user_ins'=> Auth::user()-> id ,
                'user_upd' => 0
            ]);
            return redirect()->route('employee')->with('success' ,  __('main.saved'));

        } else {
            return $this -> update($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        if($employee){
            echo json_encode($employee);
            exit();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $employee = Employee::find($request -> id);
        if($employee){
            $employee -> update([
                'name' => $request -> name,
                'phone' =>  $request -> phone ?? "",
                'address' => $request ->address ?? "",
                'salary' => $request -> salary,
                'workHoursCount' => $request -> workHoursCount,
                'workDaysCount' => $request -> workDaysCount,
                'offWeaklyDaysCount' => $request -> offWeaklyDaysCount,
                'tag' => $request -> tag ,
                'department_id' => $request -> department_id ,
                'job_id' => $request -> job_id ,
                'user_upd' => Auth::user()-> id
            ]);
        }
        return redirect()->route('employee')->with('success' ,  __('main.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if($employee){
            $employee -> delete();
            return redirect()->route('employee')->with('success' ,  __('main.deleted'));
        }
    }
}
