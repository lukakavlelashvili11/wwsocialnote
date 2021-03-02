<?php

namespace App\Http\Controllers;

use App\Models\friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class autocomplete extends Controller
{
    public function autocomplete(Request $request){
        if($request->term){
            if($request->state==1)
                $state='email';
            else if($request->state==0)
                $state='name';

            $term=$request->term;
            $data=DB::table('users')->where($state,'LIKE',$term.'%')->paginate(7);
            $userswithstatus=[];
            $bma='';
            foreach($data as $row){
                array_push($userswithstatus,
                [$row,(string)friend::where('friend1',auth()->user()->id)
                                    ->where('friend2',$row->id)
                                    ->orWhere('friend1',$row->id)
                                    ->where('friend2',auth()->user()->id)
                                    ->pluck('status')]);
            }
            $output='<ul>';
            foreach($userswithstatus as $user){
                if($user[0]->id==auth()->user()->id){
                    $bma="<span>you</span>";
                }
                if(trim($user[1],'[""]')=='' && $user[0]->id!=auth()->user()->id){
                    $bma='<img id="outimg.unknown.'.$user[0]->id.'"src="'.url('/img/friend.svg').'">';
                }
                if(trim($user[1],'[""]')=='friend'){
                    $bma='<img id="outimg.fordelete.'.$user[0]->id.'"src="'.url('/img/deletefriend.png').'">'.'<img id="outimg.friend.'.$user[0]->id.'"src="'.url('/img/paper-plane.svg').'">';
                }
                if(trim($user[1],'[""]')=='requested' && count(friend::where('friend1',$user[0]->id)->where('friend2',auth()->user()->id)->get())==0){
                    $bma='<img id="outimg.requested.'.$user[0]->id.'"src="'.url('/img/del.png').'">';
                }
                if(trim($user[1],'[""]')=='requested' && count(friend::where('friend1',$user[0]->id)->where('friend2',auth()->user()->id)->get())>0){
                    $bma='<img id="outimg.foradd.'.$user[0]->id.'"src="'.url('/img/conf.png').'">';
                }
                $output.='<li id="outli">
                <a href="'.route('account',$user[0]->id).'"style="z-index:0;color:black;text-decoration:none;">'.$user[0]->$state.'</a>
                <div id="addfriend">'.$bma.'</div>'.'</li>';
            }
            return $output.='</ul>';
            
        }
        
        
        

    }
}
