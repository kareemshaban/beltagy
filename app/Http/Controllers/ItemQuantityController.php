<?php

namespace App\Http\Controllers;

use App\Models\ItemQuantity;
use Illuminate\Http\Request;

class ItemQuantityController extends Controller
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
        //
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
     * @param  \App\Models\ItemQuantity  $itemQuantity
     * @return \Illuminate\Http\Response
     */
    public function show(ItemQuantity $itemQuantity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemQuantity  $itemQuantity
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemQuantity $itemQuantity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemQuantity  $itemQuantity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemQuantity $itemQuantity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemQuantity  $itemQuantity
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemQuantity $itemQuantity)
    {
        //
    }
}
