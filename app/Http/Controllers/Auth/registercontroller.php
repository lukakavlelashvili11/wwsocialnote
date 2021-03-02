<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class registercontroller extends Controller
{
    public function index(){
        return view('Auth.register');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|max:255',
            'email'=>'required|email|max:255|unique:users',
            'password'=>'required|min:8|confirmed|'
        ]);
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        Auth::attempt($request->only('email','password'),$request->remember);
        return redirect()->route('post');
    }
}
