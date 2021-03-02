<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class logincontroller extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function store(Request $request){
        $this->validate($request,[
            'email'=>'required|email|max:255',
            'password'=>'required|min:8|'
        ]);
        if(!Auth::attempt($request->only('email','password'),$request->remember)){
            return back()->with('status','invalid login details!');
        }
        return redirect()->route('post');
        
    }
}
