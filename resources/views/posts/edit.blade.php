@extends('layout')

@section('title')
    Edit
@endsection

@section('css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .text {
            width: 85%;
            margin: auto;
            height: auto;
        }

        #editor {
            width: 100% !important;
            height: 30em !important;
            margin: 0;
        }

        .container {
            margin: auto;
            text-align: center;
        }

    </style>
@endsection


@section('js')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="/js/posts.js"></script>

@endsection

@section('content')


    <div id="wrapper">
        <div id="page" class="container">

            <h1>Edit Post</h1>

            <form id="form" action="{{ route('posts.update', $post->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">

                    <input class="form-control" minlength="4" maxlength="255" type="text" placeholder="Title" name="title"
                        value="@if (old('title') == '') {{ $post->title }} @else {{ old('title') }} @endif">
                    @if ($errors->has('title'))
                        <p class="danger">{{ $errors->first('title') }}</p>
                    @endif
                    <br>
                    <input class="form-control" minlength="4" maxlength="255" type="text" placeholder="Excerpt"
                        name="excerpt" value="@if (old('excerpt') == '') {{ $post->excerpt }} @else {{ old('excerpt') }} @endif">
                    @if ($errors->has('excerpt'))
                        <p class="danger">{{ $errors->first('excerpt') }}</p>
                    @endif
                    <br>

                    <div id="editor" style="resize:none; width: 50%; height: 5em;" required>
                        @if (old('body') == '') {!! $post->body !!} @else {!! old('body') !!}
                        @endif
                    </div>
                    <textarea id="body" name="body" class="disappear"></textarea>
                    @if ($errors->has('body'))
                        <p class="danger">{{ $errors->first('body') }}</p>
                    @endif

                    <br>
                    <select name="category" class="form-control">
                        <option>
                            Science
                        </option>
                        <option>
                            Space
                        </option>
                        <option>
                            Fantasy
                        </option>
                    </select>

                    <br>
                    <button onclick="formSub()" type="button" class="btn button">Post</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

    </script>

@endsection
