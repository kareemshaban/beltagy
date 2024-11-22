<?php

namespace App\Http\Controllers;

use App\Models\Advance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdvanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operations = DB::table('advances')
            ->join('employees', 'advances.user_id', '=', 'employees.id')
            ->select('advances.*', 'employees.name as employe')
            ->get();
        $employees = Employee::all();
        return view('advances.index', compact('operations', 'employees'));
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
        if ($request->id == 0) {

            Advance::create([
                'user_id' => $request->user_id,
                'date' => Carbon::parse($request->date),
                'type' => $request->type,
                'amount' => $request->amount,
                'monthlyPayment' => $request->type == 0 ? $request->monthlyPayment : 0,
                'startDate' => Carbon::parse($request->startDate),
                'paymentsCount' => $request->type == 0 ? $request->paymentsCount : 0,
                'remainPaymentsCount' => $request->type == 0 ? $request->remainPaymentsCount : 0,
                'user_ins' => Auth::user()->id,
                'user_upd' => 0
            ]);
            return redirect()->route('advances')->with('success', __('main.saved'));
        } else {
            return $this->update($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $operation = Advance::find($id);
        if ($operation) {
            echo json_encode($operation);
            exit();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function edit(Advance $advance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $operation = Advance::find($request->id);
        if ($operation) {
            $operation->update([
                'user_id' => $request->user_id,
                'date' => Carbon::parse($request->date),
                'type' => $request->type,
                'amount' => $request->amount,
                'monthlyPayment' => $request->type == 0 ? $request->monthlyPayment : 0,
                'startDate' => Carbon::parse($request->startDate),
                'paymentsCount' => $request->type == 0 ? $request->paymentsCount : 0,
                'remainPaymentsCount' => $request->type == 0 ? $request->remainPaymentsCount : 0,
                'user_upd' => Auth::user()->id
            ]);
        }
        return redirect()->route('advances')->with('success', __('main.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $operation = Advance::find($id);
        if ($operation) {
            $operation->delete();
            return redirect()->route('advances')->with('success', __('main.deleted'));
        }
    }
}
