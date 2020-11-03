@extends('layout')

@section('title')
{{$post->title}}
@endsection

@section('content')

<div class="articleBody">
    <h2>
        {{$post->title}}
    </h2>
    <hr>
    <h4>by <a href="{{route('profile.show',$post->author->username)}}">{{$post->author->name}}</a></h4>
    <br>
    <br>
    <p>
        {{print($post->body)}}
    </p>
</div>
    
@endsection