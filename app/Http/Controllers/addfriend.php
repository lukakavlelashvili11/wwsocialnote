<?php

namespace App\Http\Controllers;

use App\Models\friend;
use App\Models\notifs;
use Illuminate\Http\Request;

class addfriend extends Controller
{
    public function store(Request $request){
        friend::where('friend1',$request->friend)->where('friend2',auth()->user()->id)->update(['status'=>'friend']);
        notifs::where('user_id',auth()->user()->id)->where('from',$request->friend)->delete();
        return 'ok';
    }
    public function delete(Request $request){
        friend::where('friend1',auth()->user()->id)
        ->where('friend2',$request->user)
        ->orWhere('friend1',$request->user)
        ->where('friend2',auth()->user()->id)->delete();
        notifs::where('user_id',auth()->user()->id)->where('from',$request->user)->where('notiftype','friend')->delete();
    }
}
