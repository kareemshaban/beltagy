<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientAccount;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\Stock;
use Carbon\Carbon;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = DB::table('purchases')
            -> join('clients' , 'clients.id', '=', 'purchases.client_id')
            -> select('purchases.*', 'clients.name as client') -> get();


        return view('Purchases.index', compact('purchases'));
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
        return view('Purchases.create', compact('clients' , 'items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $id =  Purchase::create([
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
        return redirect()->route('purchases')->with('success', __('main.saved'));


    }
    public function storeDetails(Request $request , $id){
        for ($i = 0 ; $i < count($request -> item_id ) ; $i++){
            PurchaseDetails::create([
                'purchase_id' => $id,
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
              'credit' => $account -> credit +  $request -> net
          ]);
      }  else {
          ClientAccount::create([
              'client_id' => $request -> client_id,
              'debit' => 0,
              'credit' => $request -> net
          ]);
      }
    }
    public function updateSock($item_id , $quantity , $weight)
    {
       $stock = Stock::where('item_id' , '=' , $item_id) -> get() -> first();
       if($stock){
           $stock -> update([
               'quantity_in' => $stock -> quantity_in +  $quantity,
               'weight_in' => $stock -> weight_in +  $weight,
               'balance' => $stock -> balance + ($quantity)
           ]);
       } else {
           Stock::create([
               'item_id' => $item_id,
               'quantity_in' => $quantity,
               'quantity_out' => 0,
               'weight_in' => $weight,
               'weight_out' => 0,
               'balance' => $quantity
           ]);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $prefix = "PI-" ;
        $id = 0 ;
        $purchases = Purchase::all();
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
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = Purchase::find($id);
        if($purchase){
            $details = PurchaseDetails::where('purchase_id' , '=' , $id) -> get();
            foreach ($details as $detail){

                $detail -> delete();
                $stock = Stock::where('item_id' , '=' , $detail -> item_id) -> get() -> first();
                if($stock){
                    $stock -> update([
                        'quantity_in' => $stock -> quantity_in -  $stock -> quantity,
                        'weight_in' => $stock -> weight_in -  $stock -> weight,
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
            return redirect()->route('purchases')->with('success', __('main.deleted'));
        }
    }

    public function view($id)
    {
        $purchase = DB::table('purchases')
            -> join('clients' , 'clients.id', '=', 'purchases.client_id')
            -> select('purchases.*', 'clients.name as client')
            -> where('purchases.id' , '=' , $id)-> get() -> first();

         $details =  DB::table('purchase_details')
            -> join('items' , 'items.id', '=', 'purchase_details.item_id')
            -> select('purchase_details.*', 'items.name as item_name' , 'items.code as item_code')
            ->where('purchase_details.purchase_id' , '=' , $id)-> get();

         return view ('Purchases.view' , compact('purchase' , 'details'));

    }
}
