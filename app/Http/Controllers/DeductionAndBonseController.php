<?php

namespace App\Http\Controllers;

use App\Models\DeductionAndBonse;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeductionAndBonseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operations = DB::table('deduction_and_bonses')
        -> join('employees' , 'deduction_and_bonses.user_id' , '=' , 'employees.id')
        -> select('deduction_and_bonses.*' , 'employees.name as employe')
        -> get() ;
        $employees = Employee::all();
        return view('deductionAndBonse.index' , compact('operations' , 'employees'));
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

            DeductionAndBonse::create([
                'user_id' => $request -> user_id ,
                'date' => Carbon::parse($request -> date)  ,
                'type' => $request -> type,
                'hours' => $request -> hours,
                'notes' => $request -> notes ?? "",
                'user_ins' => Auth::user()-> id ,
                'user_upd' => 0
            ]);
            return redirect()->route('deductionAndBonse')->with('success' ,  __('main.saved'));
        } else {
            return $this -> update($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeductionAndBonse  $deductionAndBonse
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $operation = DeductionAndBonse::find($id);
        if($operation){
            echo json_encode($operation);
            exit();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeductionAndBonse  $deductionAndBonse
     * @return \Illuminate\Http\Response
     */
    public function edit(DeductionAndBonse $deductionAndBonse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeductionAndBonse  $deductionAndBonse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $operation = DeductionAndBonse::find($request -> id) ;
        if($operation){
            $operation -> update([
                'user_id' => $request -> user_id ,
                'date' => Carbon::parse($request -> date)  ,
                'type' => $request -> type,
                'hours' => $request -> hours,
                'notes' => $request -> notes ?? "",
                'user_upd' => Auth::user()-> id ,
            ]);
        }
        return redirect()->route('deductionAndBonse')->with('success' ,  __('main.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeductionAndBonse  $deductionAndBonse
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $operation = DeductionAndBonse::find($id) ;
         if($operation){
            $operation -> delete();
            return redirect()->route('deductionAndBonse')->with('success' ,  __('main.deleted'));
         }
    }
}
