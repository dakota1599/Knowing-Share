@extends('layout')

@section('title')
Creators
@endsection

@section('css')
<link rel="stylesheet" href="/css/creators.css">
@endsection

@section('content')

<div class="content">

    @foreach($users as $user)
    <a class="profile" href="{{route('profile.show',$user->username)}}">
        <h3>{{$user->name}}</h3>
        <h6>&#64;{{$user->username}}</h6>
    </a>
    @endforeach
    <span class="pages" style="margin:auto; width:auto;height:auto">{{$users->links()}}</span>
</div>

@endsection