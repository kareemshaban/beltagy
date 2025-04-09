<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::all();
        return view('Jobs.index', compact('jobs'));
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
            Job::create([
               'name' => $request -> name
            ]);
            return redirect()->route('jobs')->with('success' ,  __('main.saved'));

        } else {
            return $this -> update($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::find($id);
        echo json_encode($job);
        exit();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $job = Job::find($request -> id);
        if($job){
            $job -> update([
                'name' => $request -> name
            ]);
            return redirect()->route('jobs')->with('success' ,  __('main.updated'));

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::find($id);
        if($job){
            $employees = Employee::where('job_id', '=' , $id)->get();
            if(count($employees) == 0){
                $job -> delete();
                return redirect()->route('jobs')->with('success' ,  __('main.deleted'));
            } else {
                return redirect()->route('jobs')->with('success' ,  __('main.cant_delete'));
            }

        }
    }
}
