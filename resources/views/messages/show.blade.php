@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row d-flex">
        <div class="col-md-2">
            <img src="{{ $message->user->image }}" alt="Avatar de {{ $message->user->pseudonyme }}">
        </div>
        <div class="col-md-10">
            <p>Posté par : {{ $message->user->pseudonyme }}, le {{ $message->created_at }}</p>
        </div>
    </div>
    <div class="row">
        <p>{{ $message->content }}</p>
    </div>
</div>

@endsection