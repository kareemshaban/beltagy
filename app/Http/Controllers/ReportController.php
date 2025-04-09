<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientAccount;
use App\Models\Item;
use App\Models\PaymentType;
use App\Models\Safe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function stockReport(){
        $clients = Client::all();
        $items = Item::all();
        return view('Reports.stockReport', compact( 'clients' , 'items'));
    }
    public function stockReportSearch(Request $request){

        $stocks = DB::table('stocks') ->
        join('items' , 'stocks.item_id' , '=' , 'items.id')
            -> select('stocks.*', 'items.name as item_name');
        if($request -> item_id){
            $stocks = $stocks -> where('stocks.item_id' , '=' , $request -> item_id) -> get() ;
        } else
            $stocks = $stocks -> get() ;
        return view('Reports.stock', compact('stocks' ));

    }

    public function safeReport()
    {
        $clients = Client::all();
        $types  = PaymentType::all();
        $safes = Safe::all();

        return view('Reports.safeReport', compact('clients' , 'types' , 'safes'));
    }

    public function safeReportSearch(Request $request){
        $recipits  = DB::table('recipits')
            -> join('clients' , 'recipits.client_id' , '=' , 'clients.id')
            -> join('safes' , 'recipits.safe_id' , '=' , 'safes.id')
            -> select('recipits.*', 'clients.name as client_name' , 'safes.name as safe') ;

        $catchs = DB::table('catch_recipits')
            -> join('clients' , 'catch_recipits.client_id' , '=' , 'clients.id')
            -> join('safes' , 'catch_recipits.safe_id' , '=' , 'safes.id')
            -> select('catch_recipits.*', 'clients.name as client_name' , 'safes.name as safe') ;

        if($request -> client_id != ''){
            $recipits = $recipits -> where('client_id' , '=' , $request -> client_id);
            $catchs = $catchs -> where('client_id' , '=' , $request -> client_id);
        }

        $boxes = DB::table('box_recipits')
            -> join('payment_types' , 'box_recipits.payment_type' , '=' , 'payment_types.id')
            -> join('safes' , 'box_recipits.safe_id' , '=' , 'safes.id')
            -> select('box_recipits.*', 'payment_types.name as client_name' , 'safes.name as safe') ;

        if($request -> payment_type != ''){
            $boxes = $boxes -> where('payment_type' , '=' ,  $request -> payment_type);
        }
        if($request -> safe_id != ''){
            $recipits = $recipits -> where('safe_id' , '=' , $request -> safe_id);
            $catchs = $catchs -> where('safe_id' , '=' , $request -> safe_id);
            $boxes = $boxes -> where('safe_id' , '=' ,  $request -> safe_id);
        }

        if($request -> has('dateFrom')){
            $recipits = $recipits -> where('date' , '>=' , Carbon::parse($request -> dateFrom) )
                -> where('date' , '<=' , Carbon::parse($request -> dateTo) ) ;

            $catchs = $catchs -> where('date' , '>=' , Carbon::parse($request -> dateFrom) )
                -> where('date' , '<=' , Carbon::parse($request -> dateTo) ) ;

            $boxes = $boxes -> where('date' , '>=' , Carbon::parse($request -> dateFrom) )
                -> where('date' , '<=' , Carbon::parse($request -> dateTo) ) ;
        }
        $docs = $recipits -> union($catchs) -> union($boxes) ;



        $docs = $docs -> orderBy('date', 'ASC') -> get() ;
        return view('Reports.safe', compact('docs'));


    }

   public function client_Account(){
        $clients = Client::all();

       return view('Reports.clientAccountReport', compact( 'clients' ));

   }
    public function client_AccountSearch(Request $request){
        if($request -> reportType == 2){
            return $this -> client_AccountSearch_ByItems($request);
        } else {
            $accounts = DB::table('client_accounts')->
            join('clients', 'client_accounts.client_id', '=', 'clients.id')
                ->select('client_accounts.*', 'clients.name as client_name');
            $brfors = [];
            $before = [
              'client_name' => '',
              'debit' => 0 ,
              'credit' => 0
            ];

            $purchases = DB::table('purchases')
                ->join('clients', 'clients.id', '=', 'purchases.client_id')
                ->select('purchases.id as docId', 'purchases.billNumber as docNumber', 'purchases.date as docDate',
                    'purchases.net as amount', 'purchases.type', 'clients.name as client');

            $purchasesReturn = DB::table('return_purchases')
                ->join('clients', 'clients.id', '=', 'return_purchases.client_id')
                ->select('return_purchases.id as docId', 'return_purchases.billNumber as docNumber', 'return_purchases.date as docDate',
                    'return_purchases.net as amount', 'return_purchases.type', 'clients.name as client');

            $sales = DB::table('sales')
                ->join('clients', 'clients.id', '=', 'sales.client_id')
                ->select('sales.id as docId', 'sales.billNumber as docNumber', 'sales.date as docDate',
                    'sales.net as amount', 'sales.type', 'clients.name as client');

            $salesReturn = DB::table('return_sales')
                ->join('clients', 'clients.id', '=', 'return_sales.client_id')
                ->select('return_sales.id as docId', 'return_sales.billNumber as docNumber', 'return_sales.date as docDate',
                    'return_sales.net as amount', 'return_sales.type', 'clients.name as client');

            $recipits = DB::table('recipits')
                ->join('clients', 'recipits.client_id', '=', 'clients.id')
                ->select('recipits.id as docId', 'recipits.billNumber as docNumber', 'recipits.date as docDate',
                    'recipits.amount as amount', 'recipits.type', 'clients.name as client');

            $catchs = DB::table('catch_recipits')
                ->join('clients', 'catch_recipits.client_id', '=', 'clients.id')
                ->select('catch_recipits.id as docId', 'catch_recipits.billNumber as docNumber', 'catch_recipits.date as docDate',
                    'catch_recipits.amount as amount', 'catch_recipits.type', 'clients.name as client');

            $exits = DB::table('meals_exits')
                ->join('clients', 'meals_exits.client_id', '=', 'clients.id')
                ->select('meals_exits.id as docId', 'meals_exits.code as docNumber', 'meals_exits.date as docDate',
                    'meals_exits.outingTax as amount', 'meals_exits.type', 'clients.name as client');

            $enters = DB::table('meals_enters')
                ->join('clients', 'meals_enters.client_id', '=', 'clients.id')
                ->select('meals_enters.id as docId', 'meals_enters.code as docNumber', 'meals_enters.date as docDate',
                    'meals_enters.enteringTax as amount', 'meals_enters.type', 'clients.name as client');
            $saltingE = DB::table('salting_enters')
                ->join('clients', 'salting_enters.client_id', '=', 'clients.id')
                ->select('salting_enters.id as docId', 'salting_enters.code as docNumber', 'salting_enters.date as docDate',
                    'salting_enters.total as amount', 'salting_enters.type', 'clients.name as client');

            $saltingX = DB::table('salting_exits')
                ->join('clients', 'salting_exits.client_id', '=', 'clients.id')
                ->select('salting_exits.id as docId', 'salting_exits.code as docNumber', 'salting_exits.date as docDate',
                    'salting_exits.serviceTotal as amount', 'salting_exits.type', 'clients.name as client')
                ->where('salting_exits.serviceTotal', '>', 0);


            if ($request->client_id != '') {
                $accounts = $accounts->where('client_accounts.client_id', '=', $request->client_id)->get();
                $purchases = $purchases->where('purchases.client_id', '=', $request->client_id);
                $sales = $sales->where('sales.client_id', '=', $request->client_id);
                $purchasesReturn = $purchasesReturn->where('return_purchases.client_id', '=', $request->client_id);
                $salesReturn = $salesReturn->where('return_sales.client_id', '=', $request->client_id);

                $recipits = $recipits->where('recipits.client_id', '=', $request->client_id);
                $catchs = $catchs->where('catch_recipits.client_id', '=', $request->client_id);
                $exits = $exits->where('meals_exits.client_id', '=', $request->client_id);
                $enters = $enters->where('meals_enters.client_id', '=', $request->client_id);
                $saltingE = $saltingE->where('salting_enters.client_id', '=', $request->client_id);
                $saltingX = $saltingX->where('salting_exits.client_id', '=', $request->client_id);


            } else {
                $accounts = $accounts->get();
            }
            if ($request->has('dateFrom')) {
                $purchasesBeriod = clone $purchases;
                $salesBeriod = clone $sales ;
                $purchasesReturnBeriod = clone $purchasesReturn ;
                $salesReturnBeriod = clone $salesReturn ;
                $recipitsBeriod = clone $recipits ;
                $catchsBeriod = clone $catchs ;
                $exitsBeriod = clone $exits ;
                $entersBeriod = clone $enters ;
                $saltingEBeriod = clone $saltingE ;
                $saltingXBeriod = clone $saltingX ;




                $purchasesBeriod = $purchasesBeriod->where('date', '>=', Carbon::parse($request->dateFrom))
                    ->where('date', '<=', Carbon::parse($request->dateTo));
                $salesBeriod = $salesBeriod->where('date', '>=', Carbon::parse($request->dateFrom))
                    ->where('date', '<=', Carbon::parse($request->dateTo));
                $purchasesReturnBeriod = $purchasesReturnBeriod->where('date', '>=', Carbon::parse($request->dateFrom))
                    ->where('date', '<=', Carbon::parse($request->dateTo));
                $salesReturnBeriod = $salesReturnBeriod->where('date', '>=', Carbon::parse($request->dateFrom))
                    ->where('date', '<=', Carbon::parse($request->dateTo));

                $recipitsBeriod = $recipitsBeriod->where('date', '>=', Carbon::parse($request->dateFrom))
                    ->where('date', '<=', Carbon::parse($request->dateTo));
                $catchsBeriod = $catchsBeriod->where('date', '>=', Carbon::parse($request->dateFrom))
                    ->where('date', '<=', Carbon::parse($request->dateTo));
                $exitsBeriod = $exitsBeriod->where('date', '>=', Carbon::parse($request->dateFrom))
                    ->where('date', '<=', Carbon::parse($request->dateTo));
                $entersBeriod = $entersBeriod->where('date', '>=', Carbon::parse($request->dateFrom))
                    ->where('date', '<=', Carbon::parse($request->dateTo));
                $saltingEBeriod = $saltingEBeriod->where('date', '>=', Carbon::parse($request->dateFrom))
                    ->where('date', '<=', Carbon::parse($request->dateTo));
                $saltingXBeriod = $saltingXBeriod->where('date', '>=', Carbon::parse($request->dateFrom))
                    ->where('date', '<=', Carbon::parse($request->dateTo));




                $purchasesBefore = $purchases->where('date', '<', Carbon::parse($request->dateFrom));
                $salesBefore = $sales->where('date', '<', Carbon::parse($request->dateFrom));
                $purchasesReturnBefore = $purchasesReturn->where('date', '<', Carbon::parse($request->dateFrom));
                $salesReturnBefore = $salesReturn->where('date', '<', Carbon::parse($request->dateFrom));
                $recipitsBefore = $recipits->where('date', '<', Carbon::parse($request->dateFrom));
                $catchsBefore = $catchs->where('date', '<', Carbon::parse($request->dateFrom));
                $exitsBefore = $exits->where('date', '<', Carbon::parse($request->dateFrom));
                $entersBefore = $enters->where('date', '<', Carbon::parse($request->dateFrom));
                $saltingEBefore = $saltingE->where('date', '<', Carbon::parse($request->dateFrom));
                $saltingXBefore = $saltingX->where('date', '<', Carbon::parse($request->dateFrom));





                $dataBefore = $purchasesBefore->union($salesBefore)->union($purchasesReturnBefore)->union($salesReturnBefore)
                    ->union($recipitsBefore)->union($catchsBefore)->union($exitsBefore)->union($entersBefore)
                    ->union($saltingEBefore)->union($saltingXBefore);



                if($request->client_id != ''){
                    $debit = 0 ;
                    $credit = 0 ;
                    foreach($dataBefore -> get() as $item){
                        if($item -> type == 2 ||  $item -> type == 4 || $item -> type == 12 ){
                            $debit += $item -> amount ;
                        } else {
                            $credit += $item -> amount ;
                        }

                    }
                    $before = [
                        'client_name' => $accounts[0] -> client_name,
                        'debit' => $debit ,
                        'credit' => $credit
                    ];
                    array_push($brfors , $before);


                }




                $data = $purchasesBeriod->union($salesBeriod)->union($purchasesReturnBeriod)->union($salesReturnBeriod)
                    ->union($recipitsBeriod)->union($catchsBeriod)->union($exitsBeriod)->union($entersBeriod)
                    ->union($saltingEBeriod)->union($saltingXBeriod);




            } else {
                if($request->client_id != ''){
                    $before = [
                        'client_name' => $accounts[0] -> client_name,
                        'debit' => 0 ,
                        'credit' => 0
                    ];



                    array_push($brfors , $before);
                }
                $data = $purchases->union($sales)->union($purchasesReturn)->union($salesReturn)
                    ->union($recipits)->union($catchs)->union($exits)->union($enters)
                    ->union($saltingE)->union($saltingX);
            }




         //   return $brfors ;


            if ($request->reportType == 0) {
                $data = $data->orderBy('docDate', 'ASC')->get();
                return view('Reports.clientAccount', compact('data', 'accounts' , 'brfors'));
            } else {
                $data = DB::table('client_accounts')->
                join('clients', 'client_accounts.client_id', '=', 'clients.id')->
                select('clients.name as client_name', 'client_accounts.debit', 'client_accounts.credit',
                    'client_accounts.beforeBalanceDebit', 'client_accounts.beforeBalanceCredit',);
                if ($request->client_id != '') {
                    $data = $data->where('client_accounts.client_id', '=', $request->client_id)->get();

                } else {
                    $data = $data->get();
                }

                return view('Reports.totalAccount', compact('data' ));
            }

        }

    }

    public function client_AccountSearch_ByItems(Request $request){

        $brfors = [];
        $before = [
            'client_name' => '',
            'debit' => 0 ,
            'credit' => 0
        ];


        $accounts = DB::table('client_accounts')->
        join('clients', 'client_accounts.client_id', '=', 'clients.id')
            ->select('client_accounts.*', 'clients.name as client_name');

        $purchases = DB::table('purchase_details')
            ->join('purchases', 'purchases.id', '=', 'purchase_details.purchase_id')
            ->join('items', 'items.id', '=', 'purchase_details.item_id')
            ->select('purchases.id as docId', 'purchases.billNumber as docNumber', 'purchases.date as docDate',
                'items.name as item_name', 'purchase_details.quantity', 'purchase_details.weight as weight' ,
            'purchase_details.total as amount' , 'purchases.type' , 'purchase_details.price as price');



        $purchasesReturn = DB::table('return_purchase_details')
            ->join('return_purchases', 'return_purchases.id', '=', 'return_purchase_details.return_purchase_id')
            ->join('items', 'items.id', '=', 'return_purchase_details.item_id')
            ->select('return_purchases.id as docId', 'return_purchases.billNumber as docNumber', 'return_purchases.date as docDate',
                'items.name as item_name', 'return_purchase_details.quantity', 'return_purchase_details.weight as weight' ,
                'return_purchase_details.total as amount' , 'return_purchases.type' , 'return_purchase_details.price as price');

        $sales = DB::table('sales_details')
            ->join('sales', 'sales.id', '=', 'sales_details.sales_id')
            ->join('items', 'items.id', '=', 'sales_details.item_id')
            ->select('sales.id as docId', 'sales.billNumber as docNumber', 'sales.date as docDate',
                'items.name as item_name', 'sales_details.quantity', 'sales_details.weight as weight' ,
                'sales_details.total as amount' , 'sales.type' , 'sales_details.price as price');


        $salesReturn = DB::table('return_sales_details')
            ->join('return_sales', 'return_sales.id', '=', 'return_sales_details.return_sales_id')
            ->join('items', 'items.id', '=', 'return_sales_details.item_id')
            ->select('return_sales.id as docId', 'return_sales.billNumber as docNumber', 'return_sales.date as docDate',
                'items.name as item_name', 'return_sales_details.quantity', 'return_sales_details.weight as weight' ,
                'return_sales_details.total as amount' , 'return_sales.type' , 'return_sales_details.price as price');



        $recipits = DB::table('recipits')
            ->select('recipits.id as docId', 'recipits.billNumber as docNumber', 'recipits.date as docDate',
                DB::raw("'' as item_name") , DB::raw("'' as quantity")  ,DB::raw("'' as weight")  ,
                'recipits.amount as amount', 'recipits.type' , DB::raw("'' as price")      );



        $catchs = DB::table('catch_recipits')
            ->select('catch_recipits.id as docId', 'catch_recipits.billNumber as docNumber', 'catch_recipits.date as docDate',
                DB::raw("'' as item_name") ,DB::raw("'' as quantity") ,   DB::raw("'' as weight") ,
                'catch_recipits.amount as amount', 'catch_recipits.type' , DB::raw("'' as price")  );

        $exits = DB::table('meals_exits')
            ->join('items', 'items.id', '=', 'meals_exits.item_id')
            ->select('meals_exits.id as docId', 'meals_exits.code as docNumber', 'meals_exits.date as docDate',
                'items.name as item_name' ,  DB::raw("'' as quantity") , DB::raw("'' as weight") ,
                'meals_exits.outingTax as amount', 'meals_exits.type'  , DB::raw("'' as price")  );

        $enters = DB::table('meals_enters')
            ->join('items', 'items.id', '=', 'meals_enters.item_id')
            ->select('meals_enters.id as docId', 'meals_enters.code as docNumber', 'meals_enters.date as docDate',
                'items.name as item_name' , DB::raw("'' as quantity") , DB::raw("'' as weight") ,
                'meals_enters.enteringTax as amount', 'meals_enters.type' , DB::raw("'' as price")  );

        $saltingE = DB::table('salting_enters')
            ->join('items', 'items.id', '=', 'salting_enters.item_id')
            ->select('salting_enters.id as docId', 'salting_enters.code as docNumber', 'salting_enters.date as docDate',
                'items.name as item_name' ,  DB::raw("'' as quantity")  , DB::raw("'' as weight") ,
                'salting_enters.total as amount', 'salting_enters.type', DB::raw("'' as price")  );

        $saltingX = DB::table('salting_exits')
            ->join('items', 'items.id', '=', 'salting_exits.item_id')
            ->select('salting_exits.id as docId', 'salting_exits.code as docNumber', 'salting_exits.date as docDate',
                'items.name as item_name' ,  DB::raw("'' as quantity") ,  DB::raw("'' as weight") ,
                'salting_exits.serviceTotal as amount', 'salting_exits.type' , DB::raw("'' as price")  )
            ->where('salting_exits.serviceTotal', '>', 0);

        if ($request->client_id != '') {
            $accounts = $accounts->where('client_accounts.client_id', '=', $request->client_id)->get();
            $purchases = $purchases->where('purchases.client_id', '=', $request->client_id);
            $sales = $sales->where('sales.client_id', '=', $request->client_id);
            $purchasesReturn = $purchasesReturn->where('return_purchases.client_id', '=', $request->client_id);
            $salesReturn = $salesReturn->where('return_sales.client_id', '=', $request->client_id);

            $recipits = $recipits->where('recipits.client_id', '=', $request->client_id);
            $catchs = $catchs->where('catch_recipits.client_id', '=', $request->client_id);
            $exits = $exits->where('meals_exits.client_id', '=', $request->client_id);
            $enters = $enters->where('meals_enters.client_id', '=', $request->client_id);
            $saltingE = $saltingE->where('salting_enters.client_id', '=', $request->client_id);
            $saltingX = $saltingX->where('salting_exits.client_id', '=', $request->client_id);


        } else {
            $accounts = $accounts->get();
        }

        if ($request->has('dateFrom')) {
            $purchasesBeriod = clone $purchases;
            $salesBeriod = clone $sales ;
            $purchasesReturnBeriod = clone $purchasesReturn ;
            $salesReturnBeriod = clone $salesReturn ;
            $recipitsBeriod = clone $recipits ;
            $catchsBeriod = clone $catchs ;
            $exitsBeriod = clone $exits ;
            $entersBeriod = clone $enters ;
            $saltingEBeriod = clone $saltingE ;
            $saltingXBeriod = clone $saltingX ;

            $purchasesBeriod = $purchasesBeriod->where('purchases.date', '>=', Carbon::parse($request->dateFrom))
                ->where('purchases.date', '<=', Carbon::parse($request->dateTo));
            $salesBeriod = $salesBeriod->where('sales.date', '>=', Carbon::parse($request->dateFrom))
                ->where('sales.date', '<=', Carbon::parse($request->dateTo));
            $purchasesReturnBeriod = $purchasesReturnBeriod->where('return_purchases.date', '>=', Carbon::parse($request->dateFrom))
                ->where('return_purchases.date', '<=', Carbon::parse($request->dateTo));
            $salesReturnBeriod = $salesReturnBeriod->where('return_sales.date', '>=', Carbon::parse($request->dateFrom))
                ->where('return_sales.date', '<=', Carbon::parse($request->dateTo));

            $recipitsBeriod = $recipitsBeriod->where('recipits.date', '>=', Carbon::parse($request->dateFrom))
                ->where('recipits.date', '<=', Carbon::parse($request->dateTo));
            $catchsBeriod = $catchsBeriod->where('catch_recipits.date', '>=', Carbon::parse($request->dateFrom))
                ->where('catch_recipits.date', '<=', Carbon::parse($request->dateTo));
            $exitsBeriod = $exitsBeriod->where('meals_exits.date', '>=', Carbon::parse($request->dateFrom))
                ->where('meals_exits.date', '<=', Carbon::parse($request->dateTo));
            $entersBeriod = $entersBeriod->where('meals_enters.date', '>=', Carbon::parse($request->dateFrom))
                ->where('meals_enters.date', '<=', Carbon::parse($request->dateTo));
            $saltingEBeriod = $saltingEBeriod->where('salting_enters.date', '>=', Carbon::parse($request->dateFrom))
                ->where('salting_enters.date', '<=', Carbon::parse($request->dateTo));
            $saltingXBeriod = $saltingXBeriod->where('salting_exits.date', '>=', Carbon::parse($request->dateFrom))
                ->where('salting_exits.date', '<=', Carbon::parse($request->dateTo));

            $purchasesBefore = $purchases->where('purchases.date', '<', Carbon::parse($request->dateFrom));
            $salesBefore = $sales->where('sales.date', '<', Carbon::parse($request->dateFrom));
            $purchasesReturnBefore = $purchasesReturn->where('return_purchases.date', '<', Carbon::parse($request->dateFrom));
            $salesReturnBefore = $salesReturn->where('return_sales.date', '<', Carbon::parse($request->dateFrom));
            $recipitsBefore = $recipits->where('recipits.date', '<', Carbon::parse($request->dateFrom));
            $catchsBefore = $catchs->where('catch_recipits.date', '<', Carbon::parse($request->dateFrom));
            $exitsBefore = $exits->where('meals_exits.date', '<', Carbon::parse($request->dateFrom));
            $entersBefore = $enters->where('meals_enters.date', '<', Carbon::parse($request->dateFrom));
            $saltingEBefore = $saltingE->where('salting_enters.date', '<', Carbon::parse($request->dateFrom));
            $saltingXBefore = $saltingX->where('salting_exits.date', '<', Carbon::parse($request->dateFrom));





            $dataBefore = $purchases->union($salesBefore)->union($purchasesReturnBefore)->union($salesReturnBefore)
                ->union($recipitsBefore)->union($catchsBefore)->union($exitsBefore)->union($entersBefore)
                ->union($saltingEBefore)->union($saltingXBefore);

            if($request->client_id != ''){
                $debit = 0 ;
                $credit = 0 ;
                foreach($dataBefore -> get() as $item){
                    if($item -> type == 2 ||  $item -> type == 4 || $item -> type == 12 ){
                        $debit += $item -> amount ;
                    } else {
                        $credit += $item -> amount ;
                    }

                }
                $before = [
                    'client_name' => $accounts[0] -> client_name,
                    'debit' => $debit ,
                    'credit' => $credit
                ];
                array_push($brfors , $before);


            }




            $data = $purchasesBeriod->union($salesBeriod)->union($purchasesReturnBeriod)->union($salesReturnBeriod)
                ->union($recipitsBeriod)->union($catchsBeriod)->union($exitsBeriod)->union($entersBeriod)
                ->union($saltingEBeriod)->union($saltingXBeriod);


        }
        else {
            if($request->client_id != ''){
                $before = [
                    'client_name' => $accounts[0] -> client_name,
                    'debit' => 0 ,
                    'credit' => 0
                ];



                array_push($brfors , $before);
            }
            $data = $purchases->union($sales)->union($purchasesReturn)->union($salesReturn)
                ->union($recipits)->union($catchs)->union($exits)->union($enters)
                ->union($saltingE)->union($saltingX);
        }


        $data = $data->orderBy('docDate', 'ASC')->get();
        return view('Reports.clientAccountItems', compact('data', 'accounts' , 'brfors'));

    }
}
