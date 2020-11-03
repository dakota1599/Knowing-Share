@extends('layout')

@section('title')
    Contact
@endsection

@section('content')

    <form class="form" action="{{ route('email.contact') }}" method="POST">
        @csrf
        <input type="text" placeholder="Email" name="email">
        <button type="submit" class="btn btn-success">Send</button>
        @error('email')
            <div class="danger">{{ $message }}</div>
        @enderror
        @if (session('message') != null)
    <div class="success">{{session('message')}}</div>
    @endif
    </form>

@endsection
