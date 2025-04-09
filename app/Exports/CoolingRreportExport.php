<?php

namespace App\Exports;

use App\Models\MealsExit;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class CoolingRreportExport implements FromView
{

    protected $item_id;
    protected  $client_id ;

    function __construct($client_id ,  $item_id) {
        $this->client_id = $client_id;
        $this->item_id = $item_id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $enters = DB::table('meals_enters')
            -> join('items' , 'meals_enters.item_id' , '=' , 'items.id')
            -> join('clients' , 'meals_enters.client_id' , '=' , 'clients.id')
            -> select('meals_enters.*' , 'items.name as item_name' , 'items.code as item_code' ,
                'clients.name as client_name') ;

        $query = $enters ;
        if($this ->  item_id != "0" )
            $query = $enters -> where(  'meals_enters.item_id' , '=' , $this ->  item_id ) ;
        if($this -> client_id != "0")
            $query = $enters -> where(  'meals_enters.client_id' , '=' , $this -> client_id ) ;

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

        return view('Reports.mealsExcel' ,  ['data' => $data]);
    }
}
