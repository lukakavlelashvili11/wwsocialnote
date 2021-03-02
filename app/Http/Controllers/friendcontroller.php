<?php

namespace App\Http\Controllers;

use App\Events\friendRequestEvent;
use App\Models\friend;
use App\Models\notifs;
use App\Models\User;
use Illuminate\Http\Request;

class friendcontroller extends Controller
{
    public function store(Request $request){
        friend::create([
            'friend1'=>auth()->user()->id,
            'friend2'=>$request->to,
            'status'=>'requested'
        ]);
        $message=User::find(auth()->user()->id)->name.' sent you a friend request.';
        notifs::create([
            'user_id'=>$request->to,
            'from'=>auth()->user()->id,
            'post_id'=>0,
            'notification'=>$message,
            'notiftype'=>'friend',
            'status'=>'sent'
        ]);
        event(new friendRequestEvent(auth()->user()->id,$request->to));
    }
}
