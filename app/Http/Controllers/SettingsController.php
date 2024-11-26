<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index(){
        $settings = Settings::all();
        if(count($settings )){
            $setting = $settings[0];
        } else {
            $setting = null ;
        }

        return view('Settings.index' , compact('setting'));
    }

    public function store(Request $request){
        if($request -> id == 0){
            Settings::create([
                'apsents_hours_to_deduct_one_day'=> $request -> apsents_hours_to_deduct_one_day ,
                'user_ins' => Auth::user()-> id ,
                'user_upd'=> 0
            ]);
            return redirect()->route('settings')->with('success' ,  __('main.saved'));


        } else {
            $setting = Settings::find($request -> id);
            if($setting){
                $setting -> update([
                    'apsents_hours_to_deduct_one_day'=> $request -> apsents_hours_to_deduct_one_day ,
                    'user_upd'=> Auth::user()-> id 
                ]);
            }
            return redirect()->route('financialDeductionAndBonse')->with('success' ,  __('main.updated'));


        }
    }
}
