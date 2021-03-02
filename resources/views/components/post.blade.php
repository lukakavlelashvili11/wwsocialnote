@props(['post'=>$post])
<center>
    
<div class="{{'post'.$post->id}}"id="post">
<div id="subpost">
<div>
<a class="font-weight-bold text-decoration-none"href="{{route('account',$post->user_id)}}">{{$post->user->name}}</a>
<span style="margin-left: 3px;">{{$post->created_at ? $post->created_at->diffForHumans() : ""}}</span>
</div>
<div>
<p style="margin-top:0px;margin-bottom:0px;padding-top:4px;padding-bottom:4px;padding-right:4px;">{{$post->body}}</p> 
    </div>
</div>
@if ($post->img_name)
<div>    
<img src="{{Storage::url($post->img_name)}}"style="width:100%;">
</div>
@endif
<div class="d-flex justify-content-between pl-1 text-info">
    <div style="display:flex;height:100%;align-items:center">
@auth
<div style="padding:2px;">
<div class="{{$post->id}}"style="display:none;">
    <button class="text-info"style="padding:0px;border:none;background:none;"onclick="but({{$post->id}})">like</button>
</div>
@if(DB::table('likes')->where('user_id',auth()->user()->id)->where('post_id',$post->id)->first()==null)
<div class="{{$post->id}}">
    <button id="but"class="text-info"style="padding:0px;border:none;background:none;"onclick="but({{$post->id}})">like</button>
</div>
@else

<div id="{{'un'.$post->id}}">
    <button class="text-info"style="padding:0px;border:none;background:none;"onclick="destroy({{$post->id}})">unlike</button>
</div>
@endif
<div id="{{'un'.$post->id}}"style="display:none;">
    <button class="text-info"style="padding:0px;border:none;background:none;"onclick="destroy({{$post->id}})">unlike</button>
</div>
</div>
@endauth


<div id="{{$post->id}}"style="margin-left:5px;">{{$post->likes->count()}}</div>
    </div>
    <div>
@if($post->ownedBy(auth()->user()))
    <div style="height:100%;padding:2px;">
<button class="text-info"onclick="deletep({{$post->id}})"style="border:none;background:none;">delete</button>
    </div>
@endif
    </div>
</div>
</div>
</center>
