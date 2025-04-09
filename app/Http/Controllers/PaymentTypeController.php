<?php

namespace App\Http\Controllers;

use App\Models\BoxRecipit;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = PaymentType::all();
        return view('PaymentType.index', compact('types'));
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
        if ($request-> id == 0) {
            PaymentType::create([
                'name' => $request -> name,
                'details' => $request -> details ?? "" ,
                'user_ins' => Auth::user() -> id,
                'user_upd' => 0
            ]);
            return redirect()->route('paymentTypes')->with('success' ,  __('main.saved'));
        } else {
            return $this -> update($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type =PaymentType::find($id);
        echo json_encode($type);
        exit();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentType $paymentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $type =PaymentType::find($request -> id);
        if($type){
            $type -> update([
                'name' => $request -> name,
                'details' => $request -> details ?? "" ,
                'user_upd' => Auth::user() -> id
            ]);
            return redirect()->route('paymentTypes')->with('success' ,  __('main.updated'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type =PaymentType::find($id);

        if($type){
            $boxRecipits = BoxRecipit::where('payment_type', '=' , $id)->get();
            if(count($boxRecipits) > 0){
                return redirect()->route('paymentTypes')->with('success' ,  __('main.cant_delete'));
            } else {
                $type -> delete();
                return redirect()->route('paymentTypes')->with('success' ,  __('main.deleted'));
            }

        }
    }
}
