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

class SaltingExitController extends Controller
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
        $meals = DB::table('salting_exits')
            -> join('items' , 'salting_exits.item_id' , '=' , 'items.id')
            -> join('clients' , 'salting_exits.client_id' , '=' , 'clients.id')
            -> join('salting_enters' , 'salting_enters.id' , '=' ,'salting_exits.salting_enter_id')
            -> select('salting_exits.*' , 'items.name as item_name' , 'items.code as item_code' ,
                'clients.name as client' , 'salting_enters.quantity as enter_qnt' , 'outingQuantity' ,
                'salting_enters.outingWeight' , 'salting_enters.weight as enter_weight')->get();
        $items = Item::all();
        $enters = SaltingEnter::all();
        $clients = Client::all();
        return view('SaltingExit.index', compact('meals' , 'items' , 'clients' ,'enters'));
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
            $id = SaltingExit::create([
                'code' => $request -> code,
                'salting_enter_id' => $request -> salting_enter_id ,
                'item_id' => $request -> item_id,
                'client_id' => $request -> client_id,
                'date' => Carbon::parse($request -> date),
                'duration' => $request -> duration,
                'quantity' => $request -> quantity,
                'weight' => $request -> weight ,
                'serviceTotal' => $request -> serviceTotal,
                'paid' => 0 ,
                'remain' => $request -> serviceTotal ,
                'isPaid' => 0 ,
                'cost' => $request -> cost ?? 0 ,
                'notes' => $request -> notes ?? "",
                'user_ins' => Auth::user() -> id ,

                'user_upd' => 0
            ]) -> id;
          if($request -> serviceTotal > 0){
              $this -> clientAccount($request);
          }


            $this -> updateItemQuantity($request -> salting_enter_id , 0 ,  $request -> quantity , 0 , $request -> weight );
            return redirect()->route('salting_exit')->with('success' ,  __('main.saved'));

        } else {
            return  $this -> update($request);
        }
    }

    public function clientAccount(Request $request)
    {
        $accounts = ClientAccount::where('client_id' , '=' , $request -> client_id) -> get();
        if(count($accounts) > 0){
            $account = $accounts[0];
            $account -> update([
                'debit' => $account -> debit +  $request -> serviceTotal
            ]);
        }  else {
            ClientAccount::create([
                'client_id' => $request -> client_id,
                'credit' => 0,
                'debit' => $request -> serviceTotal
            ]);
        }
    }

    function updateItemQuantity($enter_id , $oldQnt , $newQnt , $oldWeight , $newWeight){
        $enter = SaltingEnter::find($enter_id);
        $qnt = $newQnt - $oldQnt ;
        $weight = $newWeight - $oldWeight ;
        $enter -> update([
            'outingQuantity' =>  $enter -> outingQuantity + $qnt ,
            'outingWeight' =>  $enter -> outingWeight + $weight ,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaltingExit  $saltingExit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exit = DB::table('salting_exits') ->
        join('salting_enters' , 'salting_exits.salting_enter_id' , '=' , 'salting_enters.id')
            -> select('salting_exits.*' , 'salting_enters.date as enteringDate')
            -> where('salting_exits.id' , '=' , $id)-> get() -> first();
        echo json_encode($exit);
        exit();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaltingExit  $saltingExit
     * @return \Illuminate\Http\Response
     */
    public function edit(SaltingExit $saltingExit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaltingExit  $saltingExit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $exit = SaltingExit::find($request -> id);
        if($exit){
            $oldQnt = $exit -> quantity;
            $oldWeight = $exit -> weight;
            $exit -> update([
                'code' => $request -> code,
                'salting_enter_id' => $request -> salting_enter_id ,
                'item_id' => $request -> item_id,
                'client_id' => $request -> client_id,
                'date' => Carbon::parse($request -> date),
                'duration' => $request -> duration,
                'quantity' => $request -> quantity,
                'serviceTotal' => $request -> serviceTotal,
                'weight' => $request -> weight ,
                'remain' => $request -> serviceTotal - $exit -> paid ,
                'notes' => $request -> notes ?? "",
                'cost' => $request -> cost ??  $exit -> cost ,
                'user_upd' => Auth::user() -> id
            ]);
        }
            $this -> updateItemQuantity($request -> salting_enter_id , $oldQnt ,  $request -> quantity , $oldWeight , $request -> weight );

        return redirect()->route('salting_exit')->with('success' ,  __('main.updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaltingExit  $saltingExit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exit = SaltingExit::find($id);
        if($exit){
             $exit->delete();
             if($exit -> serviceTotal > 0){
                 $account = ClientAccount::where('client_id' , '=' , $exit->client_id) -> get() -> first();
                 if($account){
                     $account -> update([
                         'debit' => $account -> debit -  $exit -> serviceTotal
                     ]);
                 }
             }
            return redirect()->route('salting_exit')->with('success' ,  __('main.deleted'));

        }
    }

    public function salting_report(Request  $request){
        $enters = DB::table('salting_enters')
            -> join('items' , 'salting_enters.item_id' , '=' , 'items.id')
            -> join('clients' , 'salting_enters.client_id' , '=' , 'clients.id')
            -> select('salting_enters.*' , 'items.name as item_name' , 'items.code as item_code' ,
                'clients.name as client_name');

        if($request -> ajax()){
            $query = $enters ;
            if($request -> item_id != "" )
                $query = $enters -> where(  'salting_enters.item_id' , '=' , $request -> item_id ) ;
            if($request -> client_id != "")
                $query = $enters -> where(  'salting_enters.client_id' , '=' , $request -> client_id ) ;

            $data =   $query -> get() ;
        } else {
            $data = $enters -> get() ;
        }

        $clients = Client::all();
        $items = Item::all();

        foreach ($data as $item){
            $exits = DB::table('salting_exits')
                -> join('items' , 'salting_exits.item_id' , '=' , 'items.id')
                -> join('clients' , 'salting_exits.client_id' , '=' , 'clients.id')
                -> join('salting_enters' , 'salting_enters.id' , '=' ,'salting_exits.salting_enter_id')
                -> select('salting_exits.*' , 'items.name as item_name' , 'items.code as item_code' ,
                    'clients.name as client' , 'salting_enters.quantity as enter_qnt' , 'outingQuantity' ,
                    'salting_enters.outingWeight' , 'salting_enters.weight as enter_weight')
                 -> where('salting_exits.salting_enter_id' , '=' , $item -> id)
                ->get();
            $item -> exits = $exits;
        }


        if($request -> ajax()){
            return  response() -> json(['data' => $data]) ;
        } else {
            return view('Reports.indexSalting', compact('data' , 'clients' , 'items'));
        }


    }

    public function salting_exits_enter($id){
        $enter = DB::table('salting_enters') ->
        join('items' , 'salting_enters.item_id' , '=' , 'items.id')
            -> select('salting_enters.*' , 'items.name as item_name' , 'items.code as item_code')
            ->where('salting_enters.id', '=' , $id)->get() -> first();
        echo json_encode($enter);
        exit();
    }
    public function get_exit_salting_count($enter_id){
        $exits = SaltingExit::where('salting_enter_id' , '=' , $enter_id) -> get();
        echo json_encode($exits);
        exit();
    }

    public function get_exit_salting_item($enter_id){
        $enter = SaltingEnter::find($enter_id);
        if($enter){
            $item = Item::find($enter -> item_id);
            if($item){
                echo json_encode($item);
                exit();
            }
        }
    }

    public function salting_report_print($client_id , $item_id){
        $enters = DB::table('salting_enters')
            -> join('items' , 'salting_enters.item_id' , '=' , 'items.id')
            -> join('clients' , 'salting_enters.client_id' , '=' , 'clients.id')
            -> select('salting_enters.*' , 'items.name as item_name' , 'items.code as item_code' ,
                'clients.name as client_name');

        $query = $enters ;
        if($item_id != "0" )
            $query = $enters -> where(  'salting_enters.item_id' , '=' , $item_id ) ;
        if($client_id != "0")
            $query = $enters -> where(  'salting_enters.client_id' , '=' , $client_id ) ;

        $data =   $query -> get() ;
        foreach ($data as $item){
            $exits = DB::table('salting_exits')
                -> join('items' , 'salting_exits.item_id' , '=' , 'items.id')
                -> join('clients' , 'salting_exits.client_id' , '=' , 'clients.id')
                -> join('salting_enters' , 'salting_enters.id' , '=' ,'salting_exits.salting_enter_id')
                -> select('salting_exits.*' , 'items.name as item_name' , 'items.code as item_code' ,
                    'clients.name as client' , 'salting_enters.quantity as enter_qnt' , 'outingQuantity' ,
                    'salting_enters.outingWeight' , 'salting_enters.weight as enter_weight')
                -> where('salting_exits.salting_enter_id' , '=' , $item -> id)
                ->get();
            $item -> exits = $exits;
        }

        return view('Reports.saltingPrint', compact( 'data'));
    }
    public function salting_report_excel($client_id , $item_id){

    }
}
