@extends('layout')
@section('title')
    Feed
@endsection

@section('content')

    <div class="postBody">
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


@endsection
