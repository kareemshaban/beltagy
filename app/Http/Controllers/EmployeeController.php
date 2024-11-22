<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('Employee.index' , compact('employees'));
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
                'salary' => $request -> salary,
                'workHoursCount' => $request -> workHoursCount,
                'workDaysCount' => $request -> workDaysCount,
                'offWeaklyDaysCount' => $request -> offWeaklyDaysCount,
                'tag' => $request -> tag ,
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
                'address' => $request ->address ,
                'salary' => $request -> salary,
                'workHoursCount' => $request -> workHoursCount,
                'workDaysCount' => $request -> workDaysCount,
                'offWeaklyDaysCount' => $request -> offWeaklyDaysCount,
                'tag' => $request -> tag ,
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
