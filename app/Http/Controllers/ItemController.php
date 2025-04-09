<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\MealsEnter;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
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
        $items = Item::all();
        return view('Item.index', compact('items'));
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
            Item::create([
                'name' => $request -> name,
                'code' => $request -> code,
                'description' => $request -> description ?? "",
                'user_ins' => Auth::user()-> id,
                'user_upd' => 0
            ]);
            return redirect()->route('items')->with('success' ,  __('main.saved'));

        }else {
            return $this -> update($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        if($item){
            echo json_encode($item);
            exit();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $item = Item::find($request -> id);
        if($item){
            $item -> update([
                'name' => $request -> name,
                'code' => $request -> code,
                'description' => $request -> description ?? "",
                'user_upd' => Auth::user()-> id
            ]);
        }
        return redirect()->route('items')->with('success' ,  __('main.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        if($item){
            $enters = MealsEnter::where('item_id', $id)->get();
            if(count($enters) == 0){
                $item->delete();
                return redirect()->route('items')->with('success' ,  __('main.deleted'));
            } else {
                return redirect()->route('items')->with('success' ,  __('main.can_not_delete_item'));
            }

        }
    }

    public function meals($item_id){
       // $meals = MealsEnter::where('item_id', '=' , $item_id)->get();
        $meals = DB::table('meals_enters')
            -> join('items' , 'meals_enters.item_id' , '=' , 'items.id')
            -> select('meals_enters.*' , 'items.name as item_name' , 'items.code as item_code')
            ->where('meals_enters.item_id', '=' , $item_id)->get();
        echo json_encode($meals);
        exit();

    }
    public function saltings($item_id){
        $meals = DB::table('salting_enters')
            -> join('items' , 'salting_enters.item_id' , '=' , 'items.id')
            -> select('salting_enters.*' , 'items.name as item_name' , 'items.code as item_code')
            ->where('salting_enters.item_id', '=' , $item_id)->get();
        echo json_encode($meals);
        exit();
    }

    public function invoiceItems($invoice , $type){
        if($type == 0){
            //purchase
            $items = DB::table('purchase_details') -> join('items' , 'purchase_details.item_id' , '=' , 'items.id')
                -> select('items.*' , 'purchase_details.quantity as qnt' , 'purchase_details.weight as weight') -> where('purchase_details.purchase_id' , '=' , $invoice) -> get();
            echo json_encode($items);
            exit();
        } else {
            //sales
            $items = DB::table('sales_details') -> join('items' , 'sales_details.item_id' , '=' , 'items.id')
                -> select('items.*' , 'sales_details.quantity as qnt' , 'sales_details.weight as weight') -> where('sales_details.sales_id' , '=' , $invoice) -> get();
            echo json_encode($items);
            exit();
        }
    }
}
