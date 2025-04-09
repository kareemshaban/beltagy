<?php

namespace App\Http\Controllers;

use App\Models\MonthClosing;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MonthClosingController extends Controller
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
       return view('month-close.index');
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
     * @param  \App\Models\MonthClosing  $monthClosing
     * @return \Illuminate\Http\Response
     */
    public function show(MonthClosing $monthClosing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MonthClosing  $monthClosing
     * @return \Illuminate\Http\Response
     */
    public function edit(MonthClosing $monthClosing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MonthClosing  $monthClosing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MonthClosing $monthClosing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MonthClosing  $monthClosing
     * @return \Illuminate\Http\Response
     */
    public function destroy(MonthClosing $monthClosing)
    {
        //
    }
}
