@extends('layout')

@section('title')
    &#64;{{ $user->username }}
@endsection

@section('css')
    <link rel="stylesheet" href="/css/profile.css">
@endsection

@section('js')
    <script src="/js/posts.js"></script>
@endsection

@section('content')

    <div class="container" style="text-align: center">
        <div class="profile">
            <h4>General Info</h4>
            <form method="POST" action="{{ route('profile.update', $user) }}">
                @csrf
                <input type="text" placeholder="Name" name="name" value="{{ $user->name }}">
                <br>
                <input type="text" placeholder="Username" name="username" value="{{$user->username}}">
                <br>
                <input type="text" placeholder="Email" name="email" value="{{ $user->email }}">
                @error('email')
                <span class="danger">{{ $message }}</span>
                @enderror
                <br>
                <input type="text" placeholder="Bio" name="bio" value="{{ $user->bio }}">

                <h4>Update Password</h4>
                <input type="password" placeholder="Current Password" name="cpass">
                @if (session('perror') != null)
                    <span class="danger">{{ session('perror') }}</span>
                @endif
                <br>
                <input type="password" placeholder="New Password" name="npass1">
                @error('npass1')
                <span class="danger">{{ $message }}</span>
                @enderror
                <br>
                <input type="password" placeholder="Re-Type Password" name="npass2">
                <br>
                <button type="submit">Submit</button>
            </form>
            @if (session('message') != null)
                <span class="alert-success">{{ session('message') }}</span>
            @endif
        </div>

        <h1>
            Posts
        </h1>
        <hr>
        <div class="posts">
            <span class="alert-success" id="result"></span>
            <span class="pages">{{ $posts->links() }}</span>
            @foreach ($posts as $post)

                <div id="{{ $post->id }}">
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
                    <button class="deleteButton btn" onclick="deletePost({{ $post->id }},'{{ $user->username }}')">Delete
                        "{{ $post->title }}"</button>
                    <a class="editButton btn" href="{{route('posts.edit',$post->id)}}">Edit</a>
                </div>
            @endforeach
            <span class="pages">{{ $posts->links() }}</span>
        </div>
    </div>

@endsection
