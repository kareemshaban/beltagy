<?php

namespace App\Http\Controllers;

use App\Models\CatchRecipit;
use App\Models\Client;
use App\Models\ClientAccount;
use App\Models\Employee;
use App\Models\MealsEnter;
use App\Models\MealsExit;
use App\Models\Purchase;
use App\Models\Recipit;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
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
        $clients = DB::table('clients') ->
        join('client_accounts' , 'client_accounts.client_id' , '=' , 'clients.id')->
            select('clients.*' , 'client_accounts.debit' , 'client_accounts.credit' ,
        'client_accounts.beforeBalanceDebit' , 'client_accounts.beforeBalanceCredit')-> get() ;

        return view('Clients.index' , compact('clients'));


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
            $id = Client::create([
                'name' => $request -> name,
                'phone' =>  $request -> phone ?? "",
                'address' => $request ->address ?? "" ,
                'phone2' => $request -> phone2 ?? "" ,
                'mobile' => $request -> mobile ?? "" ,
                'pricingType' => $request -> pricingType,
                'enteringTaxPerBoxPerMonth' => $request -> enteringTaxPerBoxPerMonth ?? 0,
                'coolingValuePerBoxPerMonth' => $request -> coolingValuePerBoxPerMonth ?? 0,
                'user_ins'=> Auth::user()-> id ,
                'user_upd' => 0
            ]) -> id;

            ClientAccount::create([
                'client_id' => $id,
                'debit' => 0 ,
                'credit' => 0 ,
                'beforeBalanceDebit' => $request -> beforeBalanceDebit ,
                'beforeBalanceCredit' => $request -> beforeBalanceCredit
            ]);
            return redirect()->route('clients')->with('success' ,  __('main.saved'));

        } else {
            return $this -> update($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = DB::table('clients') ->
        join('client_accounts' , 'client_accounts.client_id' , '=' , 'clients.id')->
        select('clients.*' , 'client_accounts.debit' , 'client_accounts.credit' ,
            'client_accounts.beforeBalanceDebit' , 'client_accounts.beforeBalanceCredit')
            ->where('clients.id' , '=' , $id)-> get() -> first();
        if($client ){
            echo json_encode($client);
            exit();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $client = Client::find($request -> id);
        if($client){
            $client -> update([
                'name' => $request -> name,
                'phone' =>  $request -> phone ?? "",
                'address' => $request ->address ?? "",
                'phone2' => $request -> phone2 ?? "",
                'mobile' => $request -> mobile ?? "",
                'pricingType' => $request -> pricingType,
                'enteringTaxPerBoxPerMonth' => $request -> enteringTaxPerBoxPerMonth ?? 0,
                'coolingValuePerBoxPerMonth' => $request -> coolingValuePerBoxPerMonth ?? 0,
                'user_upd' => Auth::user()-> id
            ]);

            $account = ClientAccount::where('client_id' , '=' , $client->id) -> get() -> first();
            if($account){
                $account -> update([
                    'beforeBalanceDebit' => $request -> beforeBalanceDebit ,
                    'beforeBalanceCredit' => $request -> beforeBalanceCredit
                ]);
            }
        }
        return redirect()->route('clients')->with('success' ,  __('main.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        if($client){
            $exits = MealsEnter::where('client_id' , $client->id)->get();
            $enters = MealsExit::where('client_id' , $client->id)->get();
            $sales = Sales::where('client_id' , $client->id)->get();
            $purchases = Purchase::where('client_id' , $client->id)->get();
            $recipits = Recipit::where('client_id' , $client->id)->get();
            $catches = CatchRecipit::where('client_id' , $client->id)->get();

            if(count($exits) == 0 && count($enters)  == 0 && count($sales) && count($purchases) == 0 && count($catches) == 0){
                $client->delete();
                return redirect()->route('clients')->with('success' ,  __('main.deleted'));
            } else {
                return redirect()->route('clients')->with('success' ,  __('main.client_can_not_delete'));
            }


        }
    }
}
