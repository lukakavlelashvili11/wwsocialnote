<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;

class accountcontroller extends Controller
{
    public function index($id){
        $posts=post::where('user_id',$id)->get();
        $posts=$posts->reverse();
        return view('account')->with('posts',$posts);
        
    }
}
