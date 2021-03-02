<?php

namespace App\Http\Controllers;

use App\Models\notifs;
use Illuminate\Http\Request;

class getnotifscontroller extends Controller
{
    public function get(){
        notifs::where('status','sent')->update(['status'=>'seen']);
        $array=[];
        foreach(auth()->user()->notifs as $notif){
            array_push($array,[$notif->from,$notif->notification,$notif->notiftype,$notif->post_id,$notif->created_at->format('dM H:i')]);
        }
        return $array;
    }
}
