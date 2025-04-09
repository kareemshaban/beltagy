<?php

namespace App\Http\Controllers;

use App\Models\CatchRecipit;
use App\Models\Client;
use App\Models\ClientAccount;
use App\Models\Safe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CatchRecipitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        $safes = Safe::all();

        $docs  = DB::table('catch_recipits')
            -> join('clients' , 'clients.id', '=', 'catch_recipits.client_id')
            -> join('safes' , 'safes.id', '=', 'catch_recipits.safe_id')
            -> select('catch_recipits.*', 'clients.name as client' , 'safes.name as safe') -> get();
        return view('Catchs.index', compact('docs' , 'clients' , 'safes'));
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
        CatchRecipit::create([
            'billNumber' => $request ->billNumber ,
            'date' => Carbon::parse($request -> date),
            'safe_id' => $request -> safe_id,
            'client_id' => $request -> client_id,
            'amount' => $request -> amount,
            'notes' => $request -> notes ?? "",
            'user_ins' => Auth::user() -> id,
            'user_upd' => 0
        ]);
        $this -> updateClientAccount($request);
        return redirect()->route('cathes')->with('success', __('main.saved'));
    }

    public function  updateClientAccount(Request $request)
    {
        $accounts = ClientAccount::where('client_id' , '=' , $request -> client_id) -> get();
        if(count($accounts) > 0){
            $account = $accounts[0];
            $account -> update([
                'credit' => $account -> credit +  $request -> amount
            ]);
        }  else {
            ClientAccount::create([
                'client_id' => $request -> client_id,
                'credit' => $request -> amount,
                'debit' =>  0
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CatchRecipit  $catchRecipit
     * @return \Illuminate\Http\Response
     */
    public function show(CatchRecipit $catchRecipit)
    {
        //
    }
    public function getCatch(){
        $prefix = "CD-" ;
        $id = 0 ;
        $purchases = CatchRecipit::all();
        if(count($purchases) > 0){
            $purchase = $purchases[count($purchases) -1];
            $id =  $purchase->id + 1;
        } else {
            $id = 1 ;
        }
        $billNumber =  $prefix .  str_pad($id, 6, '0', STR_PAD_LEFT);
        echo  json_encode($billNumber );
        exit();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CatchRecipit  $catchRecipit
     * @return \Illuminate\Http\Response
     */
    public function edit(CatchRecipit $catchRecipit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CatchRecipit  $catchRecipit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CatchRecipit $catchRecipit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CatchRecipit  $catchRecipit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipit = CatchRecipit::find($id);
        if($recipit){
            $accounts = ClientAccount::where('client_id' , '=' , $recipit -> client_id) -> get();
            if(count($accounts) > 0){
                $account = $accounts[0];
                $account -> update([
                    'credit' => $account -> credit -  $recipit -> amount
                ]);
            }
            $recipit -> delete();
            return redirect()->route('recipits')->with('success', __('main.deleted'));

        }
    }
    public function view($id){
        $doc  = DB::table('catch_recipits')
            -> join('clients' , 'clients.id', '=', 'catch_recipits.client_id')
            -> join('safes' , 'safes.id', '=', 'catch_recipits.safe_id')
            -> select('catch_recipits.*', 'clients.name as client' , 'safes.name as safe')
            -> where('catch_recipits.id' , '=' , $id) -> get() -> first();
        echo json_encode($doc);
        exit();

    }
}
