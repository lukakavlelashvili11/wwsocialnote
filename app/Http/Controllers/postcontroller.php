<?php

namespace App\Http\Controllers;

use App\Events\joinedUsers;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class postcontroller extends Controller
{
    public function index(){
        $posts=post::with(['user','likes'])->get();
        $posts=$posts->reverse();
        event(new joinedUsers());
        return view('post')->with('posts',$posts);
    }
    public function store(Request $request){
        if(empty($request->fil)&&empty($request->fil))
        $this->validate($request,[
            'fil' => 'mimes:jpg,jpeg,tiff,exif,ppm,wmf,bmp,png',
            'body'=>'required|max:500'
        ],[
            'body.required'=>'the body field or photo is required!'
        ]);
        else
        $this->validate($request,[
            'fil' => 'mimes:jpg,jpeg,tiff,exif,ppm,wmf,bmp,png',
            'body'=>'max:500'
            ]);
        if(empty($request->fil))
        $request->user()->posts()->create([
            'body'=>$request->body,
        ]);
        else{
        $request->user()->posts()->create([
            'body'=>$request->body,
            'img_name'=>auth()->user()->id.'/'.$request->fil->hashName()
        ]);
        $request->file('fil')->store('public/'.auth()->user()->id);
        }
        return back();
    }
    public function destroy(post $post){
        
        $post->delete();
        if($post->img_name){
            Storage::delete('public/'.$post->img_name);
        }
        return back();

    }
}
