<html>
    <head>
    <title>Log in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"href="{{asset('css/main.css')}}">
    <script src="{{asset('js/main.js')}}"></script>
    <style>
        @media only screen and (max-width: 500px) {
            .reg{
                padding:5px !important;
            }
            .form{
                padding:5px !important;
                border: none !important;
            }

        }
        </style>
    </head>
<body>
@extends('components.header')
@section('nav')
    <div class="reg d-flex justify-content-center p-5">
        <div class="form form-group p-4 border rounded"style="width:400px;">
            @if(session('status'))
            <p class="text-danger">{{session('status')}}</p>

            @endif
            <form action="{{route('login')}}"method="post">
                @csrf
                <input type="text"name="email"value="{{old('email')}}"placeholder="email"
                class="form-control mt-3 p-4 @error('email'){{'is-invalid'}}@enderror">
                @error('email')<div class="text-danger">{{$message}}</div>@enderror
                
                <input type="password"id="password"name="password"placeholder="password"
                class="form-control mt-3 p-4 @error('password'){{'is-invalid'}}@enderror">
                @error('password')<div class="text-danger">{{$message}}</div>@enderror
                <input type="checkbox" id="checkbox"class="mt-3"><label>&nbsp;show password</label>
                <input type="checkbox"name="remember" class="mt-3"><label>&nbsp;remember me</label>
                <center><button type="submit"class="btn w-50 btn-info m-3 p-2">submit</button></center>
            </form>
            <a href="/register">sign up</a>
        </div>
    </div>
@endsection
<script>
$(document).ready(function(){
    $('#checkbox').on('change', function(){
        $('#password').attr('type',$('#checkbox').prop('checked')==true?"text":"password");
    });
});
</script>
</body>
</html>