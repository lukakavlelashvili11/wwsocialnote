<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class likedpostscontroller extends Controller
{
    public function index(Request $request){
        $posts=Like::with(['user'])->join('posts','posts.id','=','likes.post_id')->where('likes.user_id','=',auth()->user()->id)->get();
        
        return view('likedposts',['posts'=>$posts]);
    }
}
