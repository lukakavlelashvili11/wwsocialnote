<?php

namespace App\Http\Controllers;

use App\Models\friend;
use App\Models\notifs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class getfriendscontroller extends Controller
{
    public function get(){
        $notifscount=count(notifs::where('status','sent')->where('user_id',auth()->user()->id)->get());
        $friends=[];
        foreach(friend::where('status','friend')->get() as $friend){
            if(auth()->user()->id==$friend->friend1){
                array_push($friends,[User::find($friend->friend2)->name,$friend->friend2]);
            }
            if(auth()->user()->id==$friend->friend2){
                array_push($friends,[User::find($friend->friend1)->name,$friend->friend1]);
            }
        }
        return [$friends,$notifscount];
    }
}
