@extends('layout')

@section('title')
    Sign In
@endsection
@section('css')
    <link rel="stylesheet" href="/css/sign.css">
@endsection

@section('js')
    <script src="/js/sign.js"></script>
@endsection

@section('content')


<div class="form-group signup card @if(session('method') == null || session('method') == 'in')disappear @endif" id="signup">
        <h3>Sign Up</h3>
        <form class="form" action="{{ route('user.signup') }}" method="POST">
            @csrf
            <input min="2" max="20" type="text" name="name" class="form-control" placeholder="Name" value='{{old('name')}}'>
            @error('name')<span class="danger">{{$message}}</span>@enderror

            <input min="4" max="10" type="text" name="username" class="form-control" placeholder="User Name" value='{{old('username')}}'>
            @error('username')<span class="danger">{{$message}}</span>@enderror

            <input min="4" type="text" name="email" class="form-control" placeholder="Email" value='{{old('email')}}'>
            @error('email')<span class="danger">{{$message}}</span>@enderror

            <input min=4 type="password" name="password1" class="form-control" placeholder="Password">
            @error('password1')<span class="danger">{{$message}}</span>@enderror

            <input min=4 type="password" name="password2" class="form-control" placeholder="ReType Password">
            @error('password2')<span class="danger">{{$message}}</span>@enderror

            <input min=4 max=100 type="text" name="secq" class="form-control" placeholder="Security Question" value='{{old('secq')}}'>
            @error('secq')<span class="danger">{{$message}}</span>@enderror

            <input min=4 max=20 type="text" name="seca" class="form-control" placeholder="Security Answer*" value='{{old('seca')}}'>
            @error('seca')<span class="danger">{{$message}}</span>@enderror

            <button type="submit" class="btn button">Enter</button>

        </form>
        <span>*Please Remember this answer, as it will be the only way to reset a forgotten password.</span>
        <br>
        <a onclick="change()" class="card-link">Already have an account?</a>
    </div>

    <div class="form-group signup card @if(session('method') != null && session('method') == 'up')disappear @endif" id="signin">
        <h3>Sign In</h3>
        <form class="form" action="{{ route('user.signin') }}" method="POST">
            @csrf
            <input min="4" type="text" name="email" class="form-control" placeholder="Email" value='{{old('email')}}'>
            @error('email')<span class="danger">{{$message}}</span>@enderror

            <input min=4 type="password" name="password" class="form-control" placeholder="Password">
            @error('password1')<span class="danger">{{$message}}</span>@enderror
            <button type="submit" class="btn button">Enter</button>

            @if(session('message') != null)
                <span class="danger">{{session('message')}}</span>
            @endif

        </form>
        <a onclick="change()" class="card-link">New? Sign up!</a>
    </div>



@endsection
