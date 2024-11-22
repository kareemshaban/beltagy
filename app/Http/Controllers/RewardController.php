<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Reward;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operations = DB::table('rewards')
        -> join('employees' , 'rewards.user_id' , '=' , 'employees.id')
        -> select('rewards.*' , 'employees.name as employe')
        -> get() ;
        $employees = Employee::all();
        return view('financialDeductionAndBonse.index' , compact('operations' , 'employees'));
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

            Reward::create([
                'user_id' => $request -> user_id ,
                'date' => Carbon::parse($request -> date)  ,
                'type' => $request -> type,
                'reward' => $request -> reward,
                'notes' => $request -> notes ?? "",
                'user_ins' => Auth::user()-> id ,
                'user_upd' => 0
            ]);
            return redirect()->route('financialDeductionAndBonse')->with('success' ,  __('main.saved'));
        } else {
            return $this -> update($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $operation = Reward::find($id);
        if($operation){
            echo json_encode($operation);
            exit();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function edit(Reward $reward)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $operation = Reward::find($request -> id) ;
        if($operation){
            $operation -> update([
                'user_id' => $request -> user_id ,
                'date' => Carbon::parse($request -> date)  ,
                'type' => $request -> type,
                'reward' => $request -> reward,
                'notes' => $request -> notes ?? "",
                'user_upd' => Auth::user()-> id ,
            ]);
        }
        return redirect()->route('financialDeductionAndBonse')->with('success' ,  __('main.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $operation = Reward::find($id) ;
        if($operation){
           $operation -> delete();
           return redirect()->route('financialDeductionAndBonse')->with('success' ,  __('main.deleted'));
        }
    }
}
