<?php

namespace App\Http\Controllers;

use App\Events\likeevent;
use App\Models\notifs;
use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class postlikecontroller extends Controller
{
    public function store(post $post,Request $request){
        $post->likes()->create([
            'user_id'=>$request->user()->id
        ]);
        $db=DB::table('likes')->where('user_id',$request->user()->id)->where('post_id',$post->id)->first();
        $message=auth()->user()->name.' liked your post.';
        notifs::create([
            'user_id'=>$post->user_id,
            'from'=>auth()->user()->id,
            'post_id'=>$post->id,
            'notification'=>$message,
            'notiftype'=>'like',
            'status'=>'sent'
        ]);

        event(new likeevent(auth()->user()->id,$post->user_id,$post));
        return [$post->likes->count(),$db];
    }
     public function destroy(post $post,Request $request){
        $request->user()->likes()->where('post_id',$post->id)->delete();
        $db=DB::table('likes')->where('user_id',$request->user()->id)->where('post_id',$post->id)->first();
        return [$post->likes->count(),$db];
     }
}
