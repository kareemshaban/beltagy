<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientAccount;
use App\Models\Item;
use App\Models\ItemQuantity;
use App\Models\MealsEnter;
use App\Models\MealsExit;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MealsEnterController extends Controller
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
        $meals = DB::table('meals_enters')
            -> join('items' , 'meals_enters.item_id' , '=' , 'items.id')
            -> join('clients' , 'meals_enters.client_id' , '=' , 'clients.id')
            -> select('meals_enters.*' , 'items.name as item_name' , 'items.code as item_code' ,
            'clients.name as client')->get();
        $items = Item::all();
        $clients = Client::all();
        return view('MealsEnter.index', compact('meals' , 'items' , 'clients'));
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
           $id = MealsEnter::create([
                'code' => $request -> code,
                'item_id' => $request -> item_id,
                'date' => Carbon::parse($request -> date),
                'quantity' => $request -> quantity,
                'outingQuantity' => 0 ,
                'client_id' => $request -> client_id,
                'enteringTax' => $request -> enteringTax,
                'notes' => $request -> notes ?? "",
                'paid' => 0 ,
                'remain' => $request -> enteringTax ,
                'isPaid' => 0 ,
                'user_ins' => Auth::user() -> id ,
                'user_upd' => 0
            ]) -> id;
            if($request -> enteringTax > 0){
             $this -> clientAccount($request -> client_id , $request ->  enteringTax, 0);

            }
             $this -> updateItemQnt($request -> quantity , 0 , $id);
            return redirect()->route('meals_enter')->with('success' ,  __('main.saved'));

        } else {
            return  $this -> update($request);
        }
    }
    public function clientAccount($client_id , $amount , $oldAmount)
    {
        $accounts = ClientAccount::where('client_id' , '=' , $client_id) -> get();
        if(count($accounts) > 0){
            $account = $accounts[0];
            $account -> update([
                'debit' => $account -> debit +  $amount - $oldAmount
            ]);
        }  else {
            ClientAccount::create([
                'client_id' => $client_id,
                'credit' => 0,
                'debit' => $amount
            ]);
        }
    }


    public function updateItemQnt($newQnt , $oldQnt , $item_id){
        $itemQnt = ItemQuantity::where('item_id' , '=' , $item_id) -> get() -> first() ;
        $qnt = $newQnt - $oldQnt ;
        if($itemQnt){
            //update
            $itemQnt -> update([
                'item_id' => $item_id,
                'quantity' => $itemQnt -> quantity + $qnt
            ]);
        } else {
            ItemQuantity::create([
                'item_id' => $item_id,
                'quantity' => $qnt
            ]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MealsEnter  $mealsEnter
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $enter = MealsEnter::find($id);
        echo json_encode($enter);
        exit();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MealsEnter  $mealsEnter
     * @return \Illuminate\Http\Response
     */
    public function edit(MealsEnter $mealsEnter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MealsEnter  $mealsEnter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $enter = MealsEnter::find($request -> id);
        $oldQnt = $enter -> quantity;
        if($enter){
            $enter -> update([
                'code' => $request -> code,
                'date' => Carbon::parse($request -> date),
                'quantity' => $request -> quantity,
                'enteringTax' => $request -> enteringTax,
                'notes' => $request -> notes ?? "",
                'user_upd' => Auth::user() -> id
            ]);

            $this -> clientAccount($enter -> client_id , $request ->  enteringTax, $enter -> enteringTax);

            $this -> updateItemQnt($request -> quantity , $oldQnt , $enter -> id);
            return redirect()->route('meals_enter')->with('success' ,  __('main.updated'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MealsEnter  $mealsEnter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exits = MealsExit::where('meal_id' , '=' , $id) -> get() ;
        if(count($exits) ==  0){
            $meal = MealsEnter::find($id);
            if($meal){
                if($meal -> enteringTax > 0){
                    $account = ClientAccount::where('client_id' , '=' , $meal->client_id) -> get() -> first();
                    if($account){
                        $account -> update([
                            'debit' => $account -> debit -  $meal -> enteringTax
                        ]);
                    }
                }

                $meal -> delete();

                $this -> updateItemQnt(0 , $meal -> quantity , $meal -> item_id);

            }
            return redirect()->route('meals_enter')->with('success' ,  __('main.deleted'));
        } else {
            return redirect()->route('meals_enter')->with('danger' ,  __('main.can_not_delete'));
        }

    }
}
