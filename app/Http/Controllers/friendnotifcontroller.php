<?php

namespace App\Http\Controllers;

use App\Models\notifs;
use App\Models\User;
use Illuminate\Http\Request;

class friendnotifcontroller extends Controller
{
    public function store(Request $request){
        $notif=notifs::where('user_id',$request->to)->where('from',$request->from)->where('notiftype','friend')->latest()->get()[0];
        return [$notif->from,$notif->notification,'friend',0,date('dM H:i')];

    }
}
