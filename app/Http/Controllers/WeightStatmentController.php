<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Item;
use App\Models\MealsEnter;
use App\Models\WeightStatment;
use App\Models\WeightStatmentDetails;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class WeightStatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weightStatments = DB::table('weight_statments')
            -> join('clients', 'weight_statments.client_id', '=', 'clients.id')
            -> join('meals_enters' , 'meals_enters.id' , '=' , 'weight_statments.meal_id')
            -> select('weight_statments.*' , 'clients.name as client' , 'meals_enters.code as meal')
            -> get();

        return view('Balance.index', compact('weightStatments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::all();
        $clients = Client::all();
        return view('Balance.create', compact('items', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WeightStatment  $weightStatment
     * @return \Illuminate\Http\Response
     */
    public function show(WeightStatment $weightStatment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WeightStatment  $weightStatment
     * @return \Illuminate\Http\Response
     */
    public function edit(WeightStatment $weightStatment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WeightStatment  $weightStatment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WeightStatment $weightStatment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WeightStatment  $weightStatment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $balance = WeightStatment::find($id);
        $details = WeightStatmentDetails::where('weight_statment_id', $id)->get();
        foreach ($details as $detail) {
            $detail->delete();
        }
        $balance -> delete();
        return redirect()->route('balance')->with('success', __('main.deleted'));

    }
}
