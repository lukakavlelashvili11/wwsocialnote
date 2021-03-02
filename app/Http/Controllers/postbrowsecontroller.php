<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;

class postbrowsecontroller extends Controller
{
    public function index(Request $request){
        $posts=post::with(['user','likes'])->where('id',$request->postId)->get();
        return $posts;

    }
}
