<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientAccount;
use App\Models\Item;
use App\Models\MealsEnter;
use App\Models\MealsExit;
use App\Models\SaltingEnter;
use App\Models\SaltingExit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaltingEnterController extends Controller
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
        $meals = DB::table('salting_enters')
            -> join('items' , 'salting_enters.item_id' , '=' , 'items.id')
            -> join('clients' , 'salting_enters.client_id' , '=' , 'clients.id')
            -> select('salting_enters.*' , 'items.name as item_name' , 'items.code as item_code' ,
                'clients.name as client')
            ->orderBy('salting_enters.date', 'asc') // You can use 'desc' for descending order
            ->get();
        $items = Item::all();
        $clients = Client::all();
        return view('SaltingEnter.index', compact('meals' , 'items' , 'clients'));
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
            $id = SaltingEnter::create([
                'code' => $request -> code,
                'item_id' => $request -> item_id,
                'client_id' => $request -> client_id,
                'date' => Carbon::parse($request -> date),
                'quantity' => $request -> quantity,
                'weight' => $request -> weight,
                'outingQuantity' => 0 ,
                'outingWeight' => 0 ,
                'price' => $request -> price ,
                'total' => $request -> total,
                'paid' => 0 ,
                'remain' => $request -> total ,
                'isPaid' => 0 ,
                'notes' => $request -> notes ?? "",
                'freshValue' => $request -> freshValue ?? 0,
                'user_ins' => Auth::user() -> id ,
                'user_upd' => 0
            ]) -> id;
            $this -> clientAccount($request , 0);
            return redirect()->route('salting_enter')->with('success' ,  __('main.saved'));

        } else {
            return  $this -> update($request);
        }
    }

    public function clientAccount(Request $request , $oldAmount)
    {
        $accounts = ClientAccount::where('client_id' , '=' , $request -> client_id) -> get();
        if(count($accounts) > 0){
            $account = $accounts[0];
            $account -> update([
                'debit' => $account -> debit +  $request -> total - $oldAmount
            ]);
        }  else {
            ClientAccount::create([
                'client_id' => $request -> client_id,
                'credit' => 0,
                'debit' => $request -> total - $oldAmount
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaltingEnter  $saltingEnter
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $enter = SaltingEnter::find($id);
        echo json_encode($enter);
        exit();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaltingEnter  $saltingEnter
     * @return \Illuminate\Http\Response
     */
    public function edit(SaltingEnter $saltingEnter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaltingEnter  $saltingEnter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $enter = SaltingEnter::find($request -> id);

        if($enter){
            $isPaid = 0 ;
            $remain = $request->total - $enter -> paid ;

            if($request -> total > $enter -> paid){
                //not pdaid
                $isPaid = 0 ;
            } else {
                $isPaid = 1 ;
            }

            $request -> client_id = $enter -> client_id ;
            $enter -> update([
                'code' => $request -> code,
                'date' => Carbon::parse($request -> date),
                'quantity' => $request -> quantity,
                'weight' => $request -> weight,
                'price' => $request -> price ,
                'total' => $request -> total,
                'remain' => $remain ,
                'isPaid' => $isPaid ,
                'notes' => $request -> notes ?? "",
                'freshValue' => $request -> freshValue ?? 0,
                'user_upd' => Auth::user() -> id ,
            ]);
            $this -> clientAccount($request , $enter -> total);


            return redirect()->route('salting_enter')->with('success' ,  __('main.updated'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaltingEnter  $saltingEnter
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $exits = SaltingExit::where('salting_enter_id' , '=' , $id) -> get() ;
        if(count($exits) ==  0){
            $meal = SaltingEnter::find($id);
            if($meal){
                $meal -> delete();
                $account = ClientAccount::where('client_id' , '=' , $meal->client_id) -> get() -> first();
                if($account){
                    $account -> update([
                        'debit' => $account -> debit -  $meal -> total
                    ]);
                }

            }
            return redirect()->route('salting_enter')->with('success' ,  __('main.deleted'));
        } else {
            return redirect()->route('salting_enter')->with('danger' ,  __('main.can_not_delete'));
        }
    }
}
