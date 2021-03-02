<?php

use App\Http\Controllers\accountcontroller;
use App\Http\Controllers\addfriend;
use App\Http\Controllers\Auth\logincontroller;
use App\Http\Controllers\Auth\logoutcontroller;
use App\Http\Controllers\Auth\registercontroller;
use App\Http\Controllers\autocomplete;
use App\Http\Controllers\chatcontroller;
use App\Http\Controllers\friendcontroller;
use App\Http\Controllers\friendnotifcontroller;
use App\Http\Controllers\getfriendscontroller;
use App\Http\Controllers\getmessages;
use App\Http\Controllers\getnotifscontroller;
use App\Http\Controllers\likedpostscontroller;
use App\Http\Controllers\notifcontroller;
use App\Http\Controllers\postbrowsecontroller;
use App\Http\Controllers\postcontroller;
use App\Http\Controllers\postlikecontroller;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {return redirect()->route('post');});
Route::get('/register',[registercontroller::class,'index'])->name('register')->middleware('guest');
Route::post('/register',[registercontroller::class,'store']);
Route::post('/login',[logincontroller::class,'store']);
Route::get('/login',[logincontroller::class,'index'])->name('login');
Route::post('/logout',[logoutcontroller::class,'store'])->name('logout');
Route::get('/post',[postcontroller::class,'index'])->name('post')->middleware('auth');
Route::post('/post',[postcontroller::class,'store']);
Route::get('/postdestroy/{post}',[postcontroller::class,'destroy'])->name('postdestroy');
Route::get('/account/{id}',[accountcontroller::class,'index'])->name('account')->middleware('auth');
Route::get('/likes/{post?}',[postlikecontroller::class,'store'])->name('likes');
Route::get('/deslikes/{post?}',[postlikecontroller::class,'destroy'])->name('deslikes');
Route::post('/autocomplete',[autocomplete::class,'autocomplete'])->name('autocomplete');
Route::get('/likedposts',[likedpostscontroller::class,'index'])->name('likedposts');
Route::post('/send',[chatcontroller::class,'send']);
Route::post('/getmessages',[getmessages::class,'get']);
Route::post('/notification',[notifcontroller::class,'likestore']);
Route::post('/friendnotification',[friendnotifcontroller::class,'store']);
Route::post('/addrequest',[friendcontroller::class,'store']);
Route::post('/addfriend',[addfriend::class,'store']);
Route::get('/addfriend',[addfriend::class,'delete']);
Route::post('/getnotifs',[getnotifscontroller::class,'get']);
Route::post('/getfriends',[getfriendscontroller::class,'get']);
Route::post('/browsepost',[postbrowsecontroller::class,'index']);