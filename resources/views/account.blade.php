<html>
<head>
    
    <title>Account</title>
    <link rel="stylesheet" href="{{asset('css/posts.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/account.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/addpost.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/header.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/main.css')}}"/>
    <script src="{{asset('js/main.js')}}"></script>
</head>
<body class="bg">
@extends('components.header')
@section('nav')
    <div class="container p-3 d-flex justify-content-center">
        <div class="w-25 mt-5">
            <center>
            <a href="{{route('likedposts')}}"class="text-decoration-none">Liked posts</a>
            </center>
        </div>
    </div>
    @if($posts->count())
    @foreach ($posts as $post)
    <x-post :post="$post"/>
    @endforeach
    @endif
        </div>
        </div>    
@endsection
<script>
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
</script>
</body>
</html>