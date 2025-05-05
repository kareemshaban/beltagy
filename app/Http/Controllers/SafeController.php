<?php

namespace App\Http\Controllers;

use App\Models\BoxRecipit;
use App\Models\CatchRecipit;
use App\Models\Recipit;
use App\Models\Safe;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class SafeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $safes = Safe::all();

        foreach ($safes as $safe) {
            $x1 = Recipit::where('safe_id', $safe->id)->sum('amount');
            $x2 = CatchRecipit::where('safe_id', $safe->id)->sum('amount');
            $x3 = BoxRecipit::where('safe_id', $safe->id)->sum('amount');
            $safe -> balance = $x2 - ($x1 + $x3);
        }




        return view('Safes.index' , compact('safes'));

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
            Safe::create([
                'code' => $request -> code,
                'name' => $request -> name,
                'openingBalance' => $request -> openingBalance,
                'balance' => 0,
                'user_ins' => Auth::user()->id,
                'user_upd' => 0
            ]);
            return redirect()->route('safes')->with('success' ,  __('main.saved'));

        } else {
            return $this -> update($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Safe  $safe
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $safe = Safe::find($id);
        echo json_encode($safe);
        exit();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Safe  $safe
     * @return \Illuminate\Http\Response
     */
    public function edit(Safe $safe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Safe  $safe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $safe = Safe::find($request -> id);
        if($safe){
            $safe -> update([
                'code' => $request -> code,
                'name' => $request -> name,
                'openingBalance' => $request -> openingBalance,
                'user_upd' => Auth::user() -> id
            ]);
            return redirect()->route('safes')->with('success' ,  __('main.updated'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Safe  $safe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $safe = Safe::find($id);
        if($safe){
            $safe -> delete();
            return redirect()->route('safes')->with('success' ,  __('main.deleted'));
        }
    }
}
