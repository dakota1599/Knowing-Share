@extends('layout')

@section('title')
    &#64;{{ $user->username }}
@endsection

@section('css')
    <link rel="stylesheet" href="/css/profile.css">
@endsection

@section('content')

    <div class="container">
        <div class="profile">
            <h2>{{ $user->name }}</h2>
            <h6>&#64;{{ $user->username }}</h6>
            <h3>{{ $user->bio }}</h3>
        </div>

        <h1>
            Posts
        </h1>
        <hr>
        <div class="posts">
            <span class="pages">{{ $posts->links() }}</span>
            @foreach ($posts as $post)
                <a href="{{ route('posts.show', $post->id) }}" class="card">
                    <h3>
                        {{ $post->title }}
                    </h3>
                    <h5>
                        {{ $post->excerpt }}
                    </h5>
                    <p style="color:grey;">
                        {{ $post->created_at }} | {{ $post->author->name }} | {{ $post->category }}
                    </p>
                </a>
            @endforeach
            <span class="pages">{{ $posts->links() }}</span>
        </div>
    </div>


@endsection
