<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function employee()
    {
        return view('welcome');
    }

    public function users(){
        $users = User::all();
        return view('Users.index', compact('users'));
    }

    public function store_user(Request $request){
        if($request -> id == 0){
            User::create([
                'name' => $request -> name,
                'email' => $request -> email,
                'password' => Hash::make($request -> password),
            ]);
            return redirect()->route('users')->with('success' ,  __('main.saved'));
        } else {
            return $this -> update_user($request);
        }

    }
    public function update_user(Request  $request){
        $user = User::find($request -> id);
        if($user){
            $user -> update([
                'name' => $request -> name,
                'email' => $request -> email
            ]);
            return redirect()->route('users')->with('success' ,  __('main.updated'));
        }
    }

    public function get_user($id){
        $user = User::find($id);
        if($user){
            echo json_encode($user);
        }
    }

    public function destroy_user($id){
        $user = User::find($id);
        if($user){
            $user -> delete();
            return redirect()->route('users')->with('success' ,  __('main.deleted'));
        }
    }
}
