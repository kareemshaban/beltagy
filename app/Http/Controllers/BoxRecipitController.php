<?php

namespace App\Http\Controllers;

use App\Models\BoxRecipit;
use App\Models\Client;
use App\Models\PaymentType;
use App\Models\Safe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BoxRecipitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = PaymentType::all();
        $safes = Safe::all();

        $docs  = DB::table('box_recipits')
            -> join('payment_types' , 'payment_types.id', '=', 'box_recipits.payment_type')
            -> join('safes' , 'safes.id', '=', 'box_recipits.safe_id')
            -> select('box_recipits.*', 'payment_types.name as paymentType' , 'safes.name as safe') -> get();
        return view('BoxRecipits.index', compact('docs' , 'types' , 'safes' ));
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
        BoxRecipit::create([
            'billNumber' => $request -> billNumber,
            'safe_id' => $request -> safe_id ,
            'date' => Carbon::parse($request -> date),
            'payment_type' => $request -> payment_type,
            'amount' => $request -> amount,
            'notes' => $request -> notes ?? "",
            'user_ins' => Auth::user() -> id,
            'user_upd' => 0
        ]);
        return redirect()->route('boxRecipits')->with('success', __('main.saved'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BoxRecipit  $boxRecipit
     * @return \Illuminate\Http\Response
     */
    public function show(BoxRecipit $boxRecipit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BoxRecipit  $boxRecipit
     * @return \Illuminate\Http\Response
     */
    public function edit(BoxRecipit $boxRecipit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BoxRecipit  $boxRecipit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoxRecipit $boxRecipit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BoxRecipit  $boxRecipit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doc = BoxRecipit::find($id);
        if($doc){
            $doc -> delete();
            return redirect()->route('boxRecipits')->with('success', __('main.deleted'));
        }
    }

    public function getBoxDoc(){
        $prefix = "BR-" ;
        $id = 0 ;
        $purchases = BoxRecipit::all();
        if(count($purchases) > 0){
            $purchase = $purchases[0];
            $id =  $purchase->id + 1;
        } else {
            $id = 1 ;
        }
        $billNumber =  $prefix .  str_pad($id, 6, '0', STR_PAD_LEFT);
        echo  json_encode($billNumber );
        exit();
    }

    public function view($id){
        $doc  = DB::table('box_recipits')
            -> join('payment_types' , 'payment_types.id', '=', 'box_recipits.payment_type')
            -> join('safes' , 'safes.id', '=', 'box_recipits.safe_id')
            -> select('box_recipits.*', 'payment_types.name as paymentType' , 'safes.name as safe')
            -> where('box_recipits.id' , '=' , $id) -> get() -> first();
        echo json_encode($doc);
        exit();

    }
}
