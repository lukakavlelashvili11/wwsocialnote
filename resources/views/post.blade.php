<html>
    <head>
    <title>Posts</title>
    <script src="{{asset('js/main.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/main.css')}}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{asset('js/app.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/posts.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/addpost.css')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<body style="background:#f7f7f7">
@extends('components.header')
@section('nav')
    <div class="d-flex justify-content-center"id="body">
        <div id="formdiv">   
            <form runat="server" action="{{route('post')}}"method="post"enctype="multipart/form-data">
                    @csrf
                <textarea id="textarea"name="body"style="line-height:15px;"placeholder="post something!"class="p-2 border-secondary rounded shadow-sm"></textarea>
                <br><br>
                <div class="d-flex justify-content-between">
                <div>
                    <button onclick="document.getElementById('fil').click()"type="button"class="btn btn-outline-info">add photo</button>
                </div>
                <div>
                    <button type="submit"class="btn btn-outline-info"id="button">post</button>
                </div>
                </div>
                <input type="file"id="fil"name="fil"onchange="readURL(this)"class="d-none"/>
                <center><div id="d"style="display:none;box-shadow:0px 0px 5px black; width:150;position:relative;top:-40px;">
                    <span role="button"onclick="readURL('exit')"style="cursor:pointer;font-weight:bold;position:absolute;top:-5px;
                    right:0px;z-index: 100;">X</span>
                    <img id="img"src="#"style="width:150px;height:auto;"/>
                </div></center>
            </form>
        @error('body')
            <p class="text-danger">{{$message}}</p>
        @enderror
        <br>
        @if($posts->count())
@foreach ($posts as $post)
@if(trim(DB::table('friends')->where('friend1',auth()->user()->id)
->where('friend2',$post->user->id)
->orWhere('friend1',$post->user->id)
->where('friend2',auth()->user()->id)
->pluck('status'),'[""]')=='friend' || auth()->user()->id==$post->user->id)
<x-post :post="$post"/>
@endif
@endforeach
@else
<center>
<div><h5>No posts yet!</h5>
    <p>Add posts or friends.</p>
</div>
</center>
@endif
    </div>
    </div>
    <x-chat/>
 
    @endsection
<script type="text/javascript">
function deletep(postid){
    $('.post'+postid).hide('slow');
    var url="{{route('postdestroy',':id')}}";
            url=url.replace(':id',postid);
    $.ajax({
        url:url,
        type:'GET',
    });
}
function destroy(desdata){
        $("#un"+desdata).hide(500);
        if($('.'+desdata).length==1){
            $('.'+desdata).show(500);
        }else{
            $('.'+desdata).first().show(500);
        }
        var url="{{route('deslikes',':id')}}";
            url=url.replace(':id',desdata);
            $.ajax({
                url:url,
                type:'GET',
                success:function(response){
                  $('#'+desdata).html(response[0]);
                  }}
    )};
    function but(but){
            $('.'+but).hide(500);
            $('#un'+but).show(500);
            if(but){
            var url="{{route('likes',':id')}}";
            url=url.replace(':id',but);
            $.ajax({
                url:url,
                type:'GET',
                success:function(data){
            $('#'+but).html(data[0]);
     }});
     }
    }
    function readURL(input) {
    if(input.files && input.files[0]){
        $('#d').show();
        var reader=new FileReader();
        reader.onload=function(e) {
            $('#img').attr('src',e.target.result);
            console.log(e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
        }
    if(input=="exit"){
        $('#d').hide();
        return false;
    }
    }
    
</script>

</body>
</html>