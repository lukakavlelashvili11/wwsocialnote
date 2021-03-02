<html>
    <head>
    <meta charset="UTF-8">
    <script src="{{asset('js/main.js')}}"></script>
    <link rel="stylesheet" href="{{asset('./css/main.css')}}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign up</title>
    <style>
        @media only screen and (max-width: 500px) {
            @media only screen and (max-width: 500px) {
            .reg{
                padding:5px !important;
            }
            .form{
                padding:5px !important;
                border: none !important;
            }

        }

        }
        </style>
    </head>
<body>
@extends('components.header')
@section('nav')
    <div class="reg d-flex justify-content-center p-5"id="reg">
        <div class="form form-group p-4 border rounded"style="width:400px;">
            <form action="{{route('register')}}"method="post">
                @csrf
                <input type="text"name="name"value="{{old('name')}}"placeholder="name"
                class="form-control  mt-3 p-4 @error('name'){{'is-invalid'}}@enderror">
                @error('name')<div class="text-danger">{{$message}}</div>@enderror
                
                <input type="text"name="email"value="{{old('email')}}"placeholder="email"
                class="form-control mt-3 p-4 @error('email'){{'is-invalid'}}@enderror">
                @error('email')<div class="text-danger">{{$message}}</div>@enderror
                
                <input type="password"id="password"name="password"placeholder="password"
                class="form-control mt-3 p-4 @error('password'){{'is-invalid'}}@enderror">
                @error('password')<div class="text-danger">{{$message}}</div>@enderror
                
                <input type="password"id="password1"name="password_confirmation"placeholder="repeat your password"
                class="form-control mt-3 p-4  @error('name'){{'is-invalid'}}@enderror">
                
                <input type="checkbox" id="checkbox"class="mt-3"><label>&nbsp;show passwords</label>
                <input type="checkbox"name="remember" class="mt-3"><label>&nbsp;remember me</label>
                <center><button type="submit"class="btn w-50 btn-info m-3 p-2">submit</button></center>
            </form>
            <a href="/login">sign in</a>
        </div>
    </div>
@endsection
<script>
$(document).ready(function(){
    $('#checkbox').on('change', function(){
        $('#password,#password1').attr('type',$('#checkbox').prop('checked')==true?"text":"password");

    });});
    
</script>
</body>
</html>