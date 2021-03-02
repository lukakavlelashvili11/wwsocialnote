<html>
    <head>
        <title>Liked posts</title>
        <script src="{{asset('js/main.js')}}"></script>
        <link rel="stylesheet" href="{{asset('css/main.css')}}"/>
        <link rel="stylesheet" href="{{asset('css/likedposts.css')}}"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        #pir{
            height:fit-content;
            background:white;
            box-shadow: 0px 0px 10px #888888;
            width:400px;
            padding-bottom:0px !important;
            border:1px solid gray;
            border-radius:10px;
            margin:15px;
            
        }
        .parent{
            width:100%;
            border:1px solid black;
            display:flex;
            flex-direction: row;
            flex-wrap:wrap;
           
        }
        </style>
    </head>
<body class="bg">
@extends('components.header')
@section('nav')
    <div class="container p-3 d-flex justify-content-center">
        <div class="w-25">
            <center>
            <p>liked posts</p>
            </center>
        </div>
    </div>
    
    @if($posts->count())
    <center>
    <div style="margin-left:50px;display:flex;flex-wrap:wrap;" class="grid js-masonry"
    data-masonry-options='{ "itemSelector": ".grid-item", "columnWidth": 200,"gutter":15 }'>
    @foreach ($posts as $post)
    
    <div id="{{'post'.$post->id}}" class="grid-item">
        <div class="body"style="margin-top:5px;display:block;margin-left:7px;text-align:left;overflow-wrap: break-word !important;line-height:16px;">
        <div >
        <a class="font-weight-bold text-decoration-none"href="{{route('account',$post->user_id)}}">{{$post->user->name}}</a>
        <span style="margin-left: 3px;">{{$post->created_at ? $post->created_at->diffForHumans() : ""}}</span>
        </div>
        <div style="overflow-wrap: break-word !important;">
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
    
    
    <div id="{{$post->id}}"style="margin-left:5px;">{{DB::table('likes')->where('post_id',$post->id)->get()->count()}}</div>
        </div>
        <div>
        </div>
    </div>
    </div>
    
        
    @endforeach
</div>
</center>
@else
<center>
<div><h5>liked posts does not exist!</h5></div>
</center>
    @endif
@endsection
<script>
function destroy(desdata){
        var url="{{route('deslikes',':id')}}";
            url=url.replace(':id',desdata);
            $.ajax({
                url:url,
                type:'GET',
                success:function(response){
                    $('#post'+desdata).hide('slow');
                  }}
    )};


    
</script>
</body>
</html>