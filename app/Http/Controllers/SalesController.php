<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientAccount;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\Sales;
use App\Models\SalesDetails;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = DB::table('sales')
            -> join('clients' , 'clients.id', '=', 'sales.client_id')
            -> select('sales.*', 'clients.name as client') -> get();
        return view('Sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $items = Item::all();
        return view('Sales.create', compact('clients' , 'items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Sales::create([
            'billNumber' => $request -> billNumber	,
            'date' => Carbon::parse($request -> date),
            'client_id' => $request -> client_id,
            'total' =>  $request -> total,
            'discount' => $request -> discount,
            'net' => $request -> net,
            'paid' => 0,
            'remain' => $request -> net,
            'isPaid' => 0,
            'notes' => $request -> notes ?? "",
            'user_ins' => Auth::user() -> id,
            'user_upd' => 0
        ]) -> id;
        $this -> storeDetails($request , $id);
        $this -> clientAccount($request ) ;
        return redirect()->route('sales')->with('success', __('main.saved'));
    }

    public function storeDetails(Request $request , $id){
        for ($i = 0 ; $i < count($request -> item_id ) ; $i++){
            SalesDetails::create([
                'sales_id' => $id,
                'date' => Carbon::parse($request -> date),
                'item_id' => $request -> item_id[$i],
                'quantity' => $request -> quantity[$i],
                'weight' => $request -> weight[$i],
                'price' => $request -> price[$i],
                'total' => $request -> totalRow[$i],
                'user_ins' => Auth::user() -> id,
                'user_upd' => 0
            ]);
            $this -> updateSock($request ->item_id[$i] , $request -> quantity[$i] , $request -> weight[$i] ) ;
        }

    }

    public function clientAccount(Request $request)
    {
        $accounts = ClientAccount::where('client_id' , '=' , $request -> client_id) -> get();
        if(count($accounts) > 0){
            $account = $accounts[0];
            $account -> update([
                'debit' => $account -> debit +  $request -> net
            ]);
        }  else {
            ClientAccount::create([
                'client_id' => $request -> client_id,
                'credit' => 0,
                'debit' => $request -> net
            ]);
        }
    }
    public function updateSock($item_id , $quantity , $weight)
    {
        $stock = Stock::where('item_id' , '=' , $item_id) -> get() -> first();
        if($stock){
            $stock -> update([
                'quantity_out' => $stock -> quantity_out +  $quantity,
                'weight_out' => $stock -> weight_out +  $weight,
                'balance' => $stock -> balance - ($quantity)
            ]);
        } else {
            Stock::create([
                'item_id' => $item_id,
                'quantity_in' => 0,
                'quantity_out' => $quantity,
                'weight_in' => 0,
                'weight_out' => $weight,
                'balance' => -1 * $quantity
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $prefix = "SI-" ;
        $id = 0 ;
        $purchases = Sales::all();
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
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function edit(Sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sales $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = Sales::find($id);
        if($purchase){
            $details = SalesDetails::where('sales_id' , '=' , $id) -> get();
            foreach ($details as $detail){

                $detail -> delete();
                $stock = Stock::where('item_id' , '=' , $detail -> item_id) -> get() -> first();
                if($stock){
                    $stock -> update([
                        'quantity_out' => $stock -> quantity_out -  $detail -> quantity,
                        'weight_out' => $stock -> weight_out -  $detail -> weight,
                        'balance' => $stock -> balance + ( $detail -> quantity)
                    ]);
                }
            }
            $account = ClientAccount::where('client_id' , '=' , $purchase->client_id) -> get() -> first();
            if($account){
                $account -> update([
                    'debit' => $account -> debit -  $purchase -> net
                ]);
            }
            $purchase -> delete();
            return redirect()->route('sales')->with('success', __('main.deleted'));
        }
    }

    public function view($id)
    {
        $sales = DB::table('sales')
            -> join('clients' , 'clients.id', '=', 'sales.client_id')
            -> select('sales.*', 'clients.name as client')
            -> where('sales.id' , '=' , $id)-> get() -> first();

        $details =  DB::table('sales_details')
            -> join('items' , 'items.id', '=', 'sales_details.item_id')
            -> select('sales_details.*', 'items.name as item_name' , 'items.code as item_code')
            ->where('sales_details.sales_id' , '=' , $id)-> get();

        return view ('Sales.view' , compact('sales' , 'details'));

    }
}
