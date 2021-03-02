<?php
namespace App\Http\Controllers;

use App\Models\notifs;
use App\Models\User;
use Illuminate\Http\Request;

class notifcontroller extends Controller
{
    public function likestore(Request $request){
        // notifs::where('status','sent')->update(['status','seen']);
        $notif=notifs::where('user_id',$request->to)->where('from',$request->from)->where('notiftype','like')->where('post_id',$request->post)->latest()->get()[0];
        return [$notif->from,$notif->notification,'like',$request->post,date('dM H:i')];
    }
    
}