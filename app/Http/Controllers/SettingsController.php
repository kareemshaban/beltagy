<?php

namespace App\Http\Controllers;

use App\Models\HrSettings;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
                'enteringTax'=> $request -> enteringTax ,
                'monthly_cooling_tax_per_box' => $request -> monthly_cooling_tax_per_box ,
                'user_ins' => Auth::user()-> id ,
                'user_upd'=> 0
            ]);
            return redirect()->route('settings')->with('success' ,  __('main.saved'));


        } else {
            $setting = Settings::find($request -> id);
            if($setting){
                $setting -> update([
                    'enteringTax'=> $request -> enteringTax ,
                    'monthly_cooling_tax_per_box' => $request -> monthly_cooling_tax_per_box ,
                    'user_upd'=> Auth::user()-> id
                ]);
            }
            return redirect()->route('settings')->with('success' ,  __('main.updated'));


        }
    }

    public function show(){
        $settings = Settings::all() -> first();
        echo  json_encode($settings);
        exit();
    }


    public function index2(){
        $settings = HrSettings::all();
        if(count($settings )){
            $setting = $settings[0];
        } else {
            $setting = null ;
        }

        return view('Settings.hr' , compact('setting'));
    }

    public function store2(Request $request){
        if($request -> id == 0){
            HrSettings::create([
                'allowLate'=> $request -> allowLate ,
                'allowEarly' => $request -> allowEarly ,
                'absentPenalty' => $request -> absentPenalty ,
                'user_ins' => Auth::user()-> id ,
                'user_upd'=> 0
            ]);
            return redirect()->route('settings_hr')->with('success' ,  __('main.saved'));


        } else {
            $setting = Settings::find($request -> id);
            if($setting){
                $setting -> update([
                    'enteringTax'=> $request -> enteringTax ,
                    'monthly_cooling_tax_per_box' => $request -> monthly_cooling_tax_per_box ,
                    'user_upd'=> Auth::user()-> id
                ]);
            }
            return redirect()->route('settings')->with('success' ,  __('main.updated'));


        }
    }

    public function show2(){
        $settings = HrSettings::all() -> first();
        echo  json_encode($settings);
        exit();
    }
}
