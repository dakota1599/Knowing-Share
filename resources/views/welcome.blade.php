@extends('layout')

@section('title')
    Welcome
@endsection

@section('content')

    <div class="heading">
        @if (session()->exists('auth'))
            <h1>
                Welcome to {{ session()->get('name') }}'s Knowing Share
            </h1>
        @else
            <h1>
                Welcome to Knowing Share
            </h1>
        @endif
    </div>

    @if (session('lperm') != null)
        <script>
            alert("{{ session('lperm') }}")

        </script>
    @endif

@endsection
