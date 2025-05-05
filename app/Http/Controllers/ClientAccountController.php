<?php

namespace App\Http\Controllers;

use App\Models\CatchRecipit;
use App\Models\Client;
use App\Models\ClientAccount;
use App\Models\MealsEnter;
use App\Models\MealsExit;
use App\Models\Purchase;
use App\Models\Recipit;
use App\Models\ReturnPurchase;
use App\Models\ReturnSales;
use App\Models\Sales;
use App\Models\SaltingEnter;
use App\Models\SaltingExit;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ClientAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fix_client_Account()
    {
        $clients = Client::all();
        $account = null;
        $purchases = 0;
        $returnPurchases = 0 ;
        $sales = 0 ;
        $returnSales = 0 ;
        $recipits = 0 ;
        $catches = 0 ;
        $mealsEnter = 0 ;
        $mealsExit = 0 ;
        $saltingEnter = 0 ;
        $saltingExit = 0 ;
        foreach ($clients as $client) {
            $account = ClientAccount::where('client_id', $client->id)->get() -> first();
            $purchases = Purchase::where('client_id', $client->id)->sum('net');
            $returnPurchases = ReturnPurchase::where('client_id', $client->id)->sum('net');
            $sales = Sales::where('client_id', $client->id)->sum('net');
            $returnSales = ReturnSales::where('client_id', $client->id)->sum('net');
            $recipits = Recipit::where('client_id', $client->id)->sum('amount');
            $catches = CatchRecipit::where('client_id', $client->id)->sum('amount');
            $mealsEnter = MealsEnter::where('client_id', $client->id)->sum('enteringTax');
            $mealsExit = MealsExit::where('client_id', $client->id)->sum('outingTax');
            $saltingEnter = SaltingEnter::where('client_id', $client->id)->sum('total');
            $saltingExit = SaltingExit::where('client_id', $client->id)->sum('serviceTotal');
           $debit = $returnPurchases + $sales  + $recipits + $mealsEnter + $mealsExit + $saltingEnter + $saltingExit;
           $credit = $purchases +  $returnSales + $catches ;
            if($account){
                $account -> update([
                    'debit' => $debit ,
                    'credit' => $credit ,
                ]);
            }
            else {
                ClientAccount::create([
                   'client_id' => $client->id,
                   'debit' => $debit,
                   'credit' => $credit,
                ]);
            }
            $purchases = 0;
            $returnPurchases = 0 ;
            $sales = 0 ;
            $returnSales = 0 ;
            $recipits = 0 ;
            $catches = 0 ;
            $mealsEnter = 0 ;
            $mealsExit = 0 ;
            $saltingEnter = 0 ;
            $saltingExit = 0 ;

        }
        return redirect()->route('index')->with('success' ,  __('main.clientAccountsFixed'));


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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientAccount  $clientAccount
     * @return \Illuminate\Http\Response
     */
    public function show(ClientAccount $clientAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientAccount  $clientAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientAccount $clientAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientAccount  $clientAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientAccount $clientAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientAccount  $clientAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientAccount $clientAccount)
    {
        //
    }

    public function client_account_get($id)
    {
        $clientAccount = ClientAccount::where('client_id', $id)->get() -> first();
        if($clientAccount){
            echo json_encode($clientAccount -> credit - $clientAccount -> debit);
        } else {
            echo  json_encode("0") ;
        }
        exit();
    }
}
