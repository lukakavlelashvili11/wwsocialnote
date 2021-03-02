<?php

namespace App\Http\Controllers;

use App\Events\chatevent;
use App\Models\messages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class chatcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function chat(){
        return view('fire');
    }
    public function send(Request $request){
        $user=User::find(Auth::id());
        messages::create([
            'user_id'=>$user->id,
            'key'=>$request->input('key'),
            'message'=>$request->input('message'),
            'chat_id'=>$request->input('key')+$user->id
        ]);
        event(new chatevent($request->input('message'),$user,$request->input('key')));
        

    }
}
