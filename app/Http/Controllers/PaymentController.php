<?php

namespace App\Http\Controllers;

use App\Models\MealsEnter;
use App\Models\MealsExit;
use App\Models\Payment;
use App\Models\SaltingEnter;
use App\Models\SaltingExit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
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
        //
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
        if($request -> type == 0){
            $operation = MealsEnter::find($request -> operation_id);

        }
        else if($request -> type == 1){
            $operation = MealsExit::find($request -> operation_id);
        }
        else if($request -> type == 2){
            $operation = SaltingEnter::find($request -> operation_id);
        }
        else if($request -> type == 1){
            $operation = SaltingExit::find($request -> operation_id);
        }
      $id =  Payment::create([
            'client_id' =>   $operation -> client_id,
            'date' => Carbon::parse($request -> date),
            'amount' => $request -> amount ,
            'notes' => $request -> notes ?? "" ,
            'type' => $request -> type ,
            'operation_id' => $request -> operation_id,
            'user_ins' => Auth::user() -> id,
            'user_upd' => 0 ,
        ]) -> id;
        if($id){
            $operation -> update([
                 'paid' => $operation -> paid + $request -> amount ,
                 'remain' => $operation -> remain - $request -> amount ,
                 'isPaid' =>  ($operation -> remain - $request -> amount) ==  0 ? 1 : 0
            ])  ;
        }
    return redirect()->route('client_Account')->with('success' ,  __('main.saved'));


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
