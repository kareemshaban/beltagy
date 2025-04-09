<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\ReturnSalesDetails;
use App\Models\ClientAccount ;
use App\Models\ReturnSales;
use App\Models\Sales;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReturnSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = DB::table('return_sales')
            -> join('clients' , 'clients.id', '=', 'return_sales.client_id')
            -> join('sales' , 'sales.id' , '=' , 'return_sales.salesBillId')
            -> select('return_sales.*', 'clients.name as client' , 'sales.billNumber as originalBillNumber') -> get();


        return view('ReturnSales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sales = Sales::all();
        return view('ReturnSales.create', compact('sales' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sales = Sales::find($request -> salesBillId);
        $id =  ReturnSales::create([
            'salesBillId' => $request -> salesBillId ,
            'billNumber' => $request -> billNumber	,
            'date' => Carbon::parse($request -> date),
            'client_id' => $sales -> client_id,
            'total' =>  $request -> total,
            'discount' => 0,
            'net' => $request -> total,
            'paid' => 0,
            'remain' => $request -> total,
            'isPaid' => 0,
            'notes' => $request -> notes ?? "",
            'user_ins' => Auth::user() -> id,
            'user_upd' => 0
        ]) -> id;
        $this -> storeDetails($request , $id);
        $this -> clientAccount($request , $sales -> client_id ) ;
        return redirect()->route('returnPurchase')->with('success', __('main.saved'));
    }

    public function storeDetails(Request $request , $id){
        for ($i = 0 ; $i < count($request -> item_id ) ; $i++){
            ReturnSalesDetails::create([
                'return_sales_id' => $id,
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

    public function clientAccount(Request $request , $client_id)
    {
        $accounts = ClientAccount::where('client_id' , '=' , $client_id) -> get();
        if(count($accounts) > 0){
            $account = $accounts[0];
            $account -> update([
                'credit' => $account -> credit +  $request -> total
            ]);
        }  else {
            ClientAccount::create([
                'client_id' => $client_id,
                'credit' => $request -> total,
                'debit' => 0
            ]);
        }
    }
    public function updateSock($item_id , $quantity , $weight)
    {
        $stock = Stock::where('item_id' , '=' , $item_id) -> get() -> first();
        if($stock){
            $stock -> update([
                'quantity_out' => $stock -> quantity_out -  $quantity,
                'weight_out' => $stock -> weight_out -  $weight,
                'balance' => $stock -> balance + ($quantity)
            ]);
        } else {
            Stock::create([
                'item_id' => $item_id,
                'quantity_in' => 0,
                'quantity_out' => -1 * $quantity,
                'weight_in' => 0,
                'weight_out' => -1 * $weight,
                'balance' => -1 * $quantity
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnSales  $returnSales
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $prefix = "SRI-" ;
        $id = 0 ;
        $sales = ReturnSales::all();
        if(count($sales) > 0){
            $sales = $sales[count($sales) -1];
            $id =  $sales->id + 1;
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
     * @param  \App\Models\ReturnSales  $returnSales
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnSales $returnSales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReturnSales  $returnSales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReturnSales $returnSales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnSales  $returnSales
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = ReturnSales::find($id);
        if($purchase){
            $details = ReturnSalesDetails::where('return_sales_id' , '=' , $id) -> get();
            foreach ($details as $detail){

                $detail -> delete();
                $stock = Stock::where('item_id' , '=' , $detail -> item_id) -> get() -> first();
                if($stock){
                    $stock -> update([
                        'quantity_out' => $stock -> quantity_out +  $stock -> quantity,
                        'weight_out' => $stock -> weight_out +  $stock -> weight,
                        'balance' => $stock -> balance - $stock -> quantity
                    ]);
                }
            }
            $account = ClientAccount::where('client_id' , '=' , $purchase->client_id) -> get() -> first();
            if($account){
                $account -> update([
                    'credit' => $account -> credit -  $purchase -> net
                ]);
            }
            $purchase -> delete();
            return redirect()->route('returnPurchase')->with('success', __('main.deleted'));
        }
    }
    public function view($id)
    {
        $sales = DB::table('return_sales')
            -> join('clients' , 'clients.id', '=', 'return_sales.client_id')
            -> select('return_sales.*', 'clients.name as client')
            -> where('return_sales.id' , '=' , $id)-> get() -> first();

        $details =  DB::table('return_sales_details')
            -> join('items' , 'items.id', '=', 'return_sales_details.item_id')
            -> select('return_sales_details.*', 'items.name as item_name' , 'items.code as item_code')
            ->where('return_sales_details.return_sales_id' , '=' , $id)-> get();

        return view ('ReturnSales.view' , compact('sales' , 'details'));

    }
}
