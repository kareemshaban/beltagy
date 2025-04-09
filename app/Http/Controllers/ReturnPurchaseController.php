<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientAccount;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\ReturnPurchase;
use App\Models\ReturnPurchaseDetails;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReturnPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = DB::table('return_purchases')
            -> join('clients' , 'clients.id', '=', 'return_purchases.client_id')
            -> join('purchases' , 'purchases.id' , '=' , 'return_purchases.purchaseBillId')
            -> select('return_purchases.*', 'clients.name as client' , 'purchases.billNumber as originalBillNumber') -> get();


        return view('ReturnPurchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purchases = Purchase::all();
        return view('ReturnPurchases.create', compact('purchases' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchase = Purchase::find($request -> purchaseBillId);
        $id =  ReturnPurchase::create([
            'purchaseBillId' => $request -> purchaseBillId ,
            'billNumber' => $request -> billNumber	,
            'date' => Carbon::parse($request -> date),
            'client_id' => $purchase -> client_id,
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
        $this -> clientAccount($request , $purchase -> client_id ) ;
        return redirect()->route('returnPurchase')->with('success', __('main.saved'));
    }

    public function storeDetails(Request $request , $id){
        for ($i = 0 ; $i < count($request -> item_id ) ; $i++){
            ReturnPurchaseDetails::create([
                'return_purchase_id' => $id,
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
                'debit' => $account -> debit +  $request -> total
            ]);
        }  else {
            ClientAccount::create([
                'client_id' => $client_id,
                'debit' => $request -> net,
                'credit' => 0
            ]);
        }
    }
    public function updateSock($item_id , $quantity , $weight)
    {
        $stock = Stock::where('item_id' , '=' , $item_id) -> get() -> first();
        if($stock){
            $stock -> update([
                'quantity_in' => $stock -> quantity_in -  $quantity,
                'weight_in' => $stock -> weight_in -  $weight,
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
     * @param  \App\Models\ReturnPurchase  $returnPurchase
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $prefix = "PRI-" ;
        $id = 0 ;
        $purchases = ReturnPurchase::all();
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
     * @param  \App\Models\ReturnPurchase  $returnPurchase
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnPurchase $returnPurchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReturnPurchase  $returnPurchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReturnPurchase $returnPurchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnPurchase  $returnPurchase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = ReturnPurchase::find($id);
        if($purchase){
            $details = ReturnPurchaseDetails::where('return_purchase_id' , '=' , $id) -> get();
            foreach ($details as $detail){

                $detail -> delete();
                $stock = Stock::where('item_id' , '=' , $detail -> item_id) -> get() -> first();
                if($stock){
                    $stock -> update([
                        'quantity_in' => $stock -> quantity_in +  $stock -> quantity,
                        'weight_in' => $stock -> weight_in +  $stock -> weight,
                        'balance' => $stock -> balance + $stock -> quantity
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
            return redirect()->route('returnPurchase')->with('success', __('main.deleted'));
        }
    }

    public function view($id)
    {
        $purchase = DB::table('return_purchases')
            -> join('clients' , 'clients.id', '=', 'return_purchases.client_id')
            -> select('return_purchases.*', 'clients.name as client')
            -> where('return_purchases.id' , '=' , $id)-> get() -> first();

        $details =  DB::table('return_purchase_details')
            -> join('items' , 'items.id', '=', 'return_purchase_details.item_id')
            -> select('return_purchase_details.*', 'items.name as item_name' , 'items.code as item_code')
            ->where('return_purchase_details.return_purchase_id' , '=' , $id)-> get();

        return view ('ReturnPurchases.view' , compact('purchase' , 'details'));

    }
}
