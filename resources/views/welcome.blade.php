<!-- welcome.blade.php -->

@extends('layouts.app')

@section('content')

<div>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    You are logged in!
    <div id="example"></div>
</div>

@endsection
