@extends('layout')
@section('title')
    Create
@endsection

@section('css')
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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

            <h1>New Post</h1>
            <div class="text">
            <form action="/posts" method="POST" id="form">
                @csrf
                <div class="form-group">
                    <input class="form-control" minlength="4" maxlength="255" type="text" placeholder="Title" name="title"
                        value="{{ old('title') }}">
                    @if ($errors->has('title'))
                        <p class="danger">{{ $errors->first('title') }}</p>
                    @endif
                    <br>
                    <input class="form-control" minlength="4" maxlength="255" type="text" placeholder="Excerpt"
                        name="excerpt" value="{{ old('excerpt') }}">
                    @if ($errors->has('excerpt'))
                        <p class="danger">{{ $errors->first('excerpt') }}</p>
                    @endif
                    <br>

                    <div id="editor" style="resize:none; width: 50%; height: 5em;" required>
                        {!!old('body')!!}
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
    </div>


    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

    </script>
@endsection
