<?php

namespace App\Http\Controllers;

use App\Models\messages;
use App\Models\User;
use Illuminate\Http\Request;

class getmessages extends Controller
{
    public function get(Request $request){
        $collection=messages::with('user')->where('chat_id',$request->user()->id+$request->key)->get();
        $userName=User::where('id',$request->key)->get('name');
        return [$userName,$collection];

    }
}
