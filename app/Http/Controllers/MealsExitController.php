<?php

namespace App\Http\Controllers;

use App\Exports\CoolingRreportExport;
use App\Models\Client;
use App\Models\ClientAccount;
use App\Models\Item;
use App\Models\ItemQuantity;
use App\Models\MealsEnter;
use App\Models\MealsExit;
use App\Models\Payment;
use App\Models\SaltingEnter;
use App\Models\SaltingExit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MealsExitController extends Controller
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
        $meals = DB::table('meals_exits')
            -> join('items' , 'meals_exits.item_id' , '=' , 'items.id')
            -> join('clients' , 'meals_exits.client_id' , '=' , 'clients.id')
            -> join('meals_enters' , 'meals_enters.id' , '=' ,'meals_exits.meal_id')
            -> select('meals_exits.*' , 'items.name as item_name' , 'items.code as item_code' ,
                'clients.name as client' , 'meals_enters.quantity as enter_qnt' , 'outingQuantity')->get();
        $items = Item::all();
        $enters = MealsEnter::all();
        $clients = Client::all();
        return view('MealsExit.index', compact('meals' , 'items' , 'clients' ,'enters'));
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
           $id = MealsExit::create([
                'code' => $request -> code,
                'meal_id' => $request -> meal_id ,
                'item_id' => $request -> item_id,
                'date' => Carbon::parse($request -> date),
                'quantity' => $request -> quantity,
                'client_id' => $request -> client_id,
                'outingTax' => $request -> outingTax,
                'duration' => $request -> duration,
                'notes' => $request -> notes ?? "",
                'user_ins' => Auth::user() -> id ,
               'paid' => 0 ,
               'remain' => $request -> outingTax ,
               'isPaid' => 0 ,
                'user_upd' => 0
            ]) -> id;
            $this -> clientAccount($request);
            $this -> updateItemQnt($request -> quantity , 0 , $request -> meal_id );
            return redirect()->route('meals_exit')->with('success' ,  __('main.saved'));

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
                'debit' => $account -> debit +  $request -> outingTax
            ]);
        }  else {
            ClientAccount::create([
                'client_id' => $request -> client_id,
                'credit' => 0,
                'debit' => $request -> outingTax
            ]);
        }
    }
    public function createPaymentDoc($request , $id){
        $payment = Payment::where('operation_id' , '=' , $id) -> first();
        if($payment){
            $payment -> delete();
        }
        Payment::create([
            'client_id'=> $request -> client_id,
            'date' => Carbon::parse($request -> date),
            'amount' => $request -> outingTax,
            'notes' => 'رسوم خروج وجبة',
            'type' => 1 ,
            'operation_id' => $id,
            'paidAmount' => 0 ,
            'user_ins' => Auth::user() -> id ,
            'user_upd' => 0
        ]);
    }
    public function updateItemQnt($newQnt , $oldQnt  , $enter_id){
        $itemQnt = ItemQuantity::where('item_id' , '=' , $enter_id) -> get() -> first() ;

        $qnt = $newQnt - $oldQnt ;
        if($itemQnt){
            //update
            $itemQnt -> update([
                'item_id' => $enter_id,
                'quantity' => $itemQnt -> quantity  - $qnt
            ]);
        } else {
            ItemQuantity::create([
                'item_id' => $enter_id,
                'quantity' => $qnt
            ]);

        }
        $enter = MealsEnter::find($enter_id);
        $enter -> update([
           'outingQuantity' =>  $enter -> outingQuantity + $qnt
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MealsExit  $mealsExit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //  $exit = MealsExit::find($id);
        $exit = DB::table('meals_exits') ->
        join('meals_enters' , 'meals_exits.meal_id' , '=' , 'meals_enters.id')
            -> select('meals_exits.*' , 'meals_enters.date as enteringDate')
            -> where('meals_exits.id' , '=' , $id)
            -> get() -> first();
        echo json_encode($exit);
        exit();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MealsExit  $mealsExit
     * @return \Illuminate\Http\Response
     */
    public function edit(MealsExit $mealsExit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MealsExit  $mealsExit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       // return $request ;
        $exit = MealsExit::find($request -> id);
        $oldQnt = $exit -> quantity;
        if($exit){
            $exit -> update([
                'code' => $request -> code,
                'item_id' => $request -> item_id,
                'date' => Carbon::parse($request -> date),
                'quantity' => $request -> quantity,
                'outingTax' => $request -> outingTax,
                'duration' => $request -> duration,
                'notes' => $request -> notes ?? "",
                'user_upd' => Auth::user() -> id
            ]);

            $this -> updateItemQnt($request -> quantity , $oldQnt , $exit -> meal_id );


            return redirect()->route('meals_exit')->with('success' ,  __('main.updated'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MealsExit  $mealsExit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $meal = MealsExit::find($id);
        if($meal){
            $meal -> delete();
            $account = ClientAccount::where('client_id' , '=' , $meal->client_id) -> get() -> first();
            if($account){
                $account -> update([
                    'debit' => $account -> debit -  $meal -> outingTax
                ]);
            }

            $this -> updateItemQnt(0 , $meal -> quantity ,  $meal -> meal_id);

        }
        return redirect()->route('meals_exit')->with('success' ,  __('main.deleted'));
    }

    public function item_meals_exit($id){
       $enter = DB::table('meals_enters') ->
       join('items' , 'meals_enters.item_id' , '=' , 'items.id')
           -> select('meals_enters.*' , 'items.name as item_name' , 'items.code as item_code')
           ->where('meals_enters.id', '=' , $id)->get() -> first();
        echo json_encode($enter);
        exit();
    }
    public function get_exit_meal_count($enter_id){
        $exits = MealsExit::where('meal_id' , '=' , $enter_id) -> get();
        echo json_encode($exits);
        exit();
    }

    public function get_exit_meal_item($enter_id){
        $enter = MealsEnter::find($enter_id);
        if($enter){
            $item = Item::find($enter -> item_id);
            if($item){
                echo json_encode($item);
                exit();
            }
        }
    }

    public function meals_report(Request   $request){
        $enters = DB::table('meals_enters')
            -> join('items' , 'meals_enters.item_id' , '=' , 'items.id')
            -> join('clients' , 'meals_enters.client_id' , '=' , 'clients.id')
            -> select('meals_enters.*' , 'items.name as item_name' , 'items.code as item_code' , 'clients.name as client_name');

        if($request -> ajax()){
            $query = $enters ;
            if($request -> item_id != "" )
            $query = $enters -> where(  'meals_enters.item_id' , '=' , $request -> item_id ) ;
            if($request -> client_id != "")
            $query = $enters -> where(  'meals_enters.client_id' , '=' , $request -> client_id ) ;

             $data =   $query -> get() ;
        } else {
            $data = $enters -> get() ;
        }

        $clients = Client::all();
        $items = Item::all();

        foreach ($data as $item){
            $exits = DB::table('meals_exits')
                -> join('items' , 'meals_exits.item_id' , '=' , 'items.id')
                -> join('clients' , 'meals_exits.client_id' , '=' , 'clients.id')
                -> join('meals_enters' , 'meals_enters.id' , '=' ,'meals_exits.meal_id')
                -> select('meals_exits.*' , 'items.name as item_name' , 'items.code as item_code' ,
                    'clients.name as client' , 'meals_enters.quantity as enter_qnt' , 'outingQuantity' )
                -> where('meals_exits.meal_id' , '=' , $item -> id)
                ->get();
            $item -> exits = $exits;
        }
        if($request -> ajax()){
          return  response() -> json(['data' => $data]) ;
        } else {
            return view('Reports.index', compact('data' , 'clients' , 'items'));
        }



    }



    function operation_get($id , $type){
        if($type == 0){
            $operation = MealsEnter::find($id);

        }
        else if($type == 1){
            $operation = MealsExit::find($id);
        } else if($type == 2){
            $operation = SaltingEnter::find($id);
        }
        else if($type == 3){
            $operation = SaltingExit::find($id);
        }

        $operation  -> type = $type;
        echo json_encode($operation);
        exit();

    }

    public function client_Account_print($client_id){
        $enter = MealsEnter::where('client_id' , '=' , $client_id) -> get();
        $exit = MealsExit::where('client_id' , '=' , $client_id) -> get();
        $enterS = SaltingEnter::where('client_id' , '=' , $client_id) -> get();
        $exitS = SaltingExit::where('client_id' , '=' , $client_id)
            -> where('serviceTotal' ,'>' , 0)-> get();
        $payments = Payment::where('client_id' , '=' , $client_id) -> get();
        $client = Client::find($client_id);
        $total = 0 ;
        foreach ($enter as $enter){
            $total += $enter -> remain ;
        }
        foreach ($exit as $exit){
            $total += $exit -> remain ;
        }
        foreach ($enterS as $enters){
            $total += $enters -> remain ;
        }
        foreach ($exitS as $exits){
            $total += $exit -> remain ;
        }

        $client_name  = $client -> name ;

        return view('Reports.totalAccount', compact('total' , 'client_name'));

    }


    public function  meals_report_print($client_id , $item_id)
    {
        $enters = DB::table('meals_enters')
            -> join('items' , 'meals_enters.item_id' , '=' , 'items.id')
            -> join('clients' , 'meals_enters.client_id' , '=' , 'clients.id')
            -> select('meals_enters.*' , 'items.name as item_name' , 'items.code as item_code' ,
                'clients.name as client_name') ;

        $query = $enters ;
        if($item_id != "0" )
            $query = $enters -> where(  'meals_enters.item_id' , '=' , $item_id ) ;
        if($client_id != "0")
            $query = $enters -> where(  'meals_enters.client_id' , '=' , $client_id ) ;

        $data =   $query -> get() ;
        foreach ($data as $item){
            $exits = DB::table('meals_exits')
                -> join('items' , 'meals_exits.item_id' , '=' , 'items.id')
                -> join('clients' , 'meals_exits.client_id' , '=' , 'clients.id')
                -> join('meals_enters' , 'meals_enters.id' , '=' ,'meals_exits.meal_id')
                -> select('meals_exits.*' , 'items.name as item_name' , 'items.code as item_code' ,
                    'clients.name as client' , 'meals_enters.quantity as enter_qnt' , 'outingQuantity' )
                -> where('meals_exits.meal_id' , '=' , $item -> id)
                ->get();
            $item -> exits = $exits;
        }

        return view('Reports.mealsPrint', compact( 'data'));
    }

    public function meals_report_excel($client_id , $item_id){

        return Excel::download(new CoolingRreportExport($client_id , $item_id), 'cooling.xlsx');


    }
}
