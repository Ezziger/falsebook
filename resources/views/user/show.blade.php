@extends('layouts.app')

@section('content')
<h1>Profil de {{ $user->pseudonyme }}</h1>

<img src="{{$user->image}}" alt="Avatar de l'utilisateur {{$user->pseudonyme}}">
<h2>Nom : {{$user->nom}}</h2>
<h2>Prenom : {{$user->prenom}}</h2>
<h2>Pseudo : {{$user->pseudonyme}}</h2>
<h2>Email : {{$user->email}}</h2>

@foreach ($user->messages as $message)
<div class="card">
  <div class="card-header">
  #{{ $message->tags }}
  </div>
  <div class="row">
    <div class="col-md-3">
      <img src="{{ $message->image }}" alt="">
    </div>
    <div class="col-md-9 card-body">
      <blockquote class="blockquote mb-0">
        <p>{{ $message->content }}</p>
        <footer class="blockquote-footer">Posté par : <a href="{{ route('user.show', $message->user->id) }}">{{ $message->user->pseudonyme }}</a> le {{ $message->created_at }}</footer>
      </blockquote>
      <a href="{{route('messages.show', $message->id)}}" class="btn btn-outline-dark btn-sm">Details</a>
      @can('update', $message)
      <a href="{{route('messages.edit', $message->id)}}" class="btn btn-outline-dark btn-sm">Modifier votre message</a>
      @endcan
      @can('delete', $message)
      <form action="{{ route('messages.destroy', $message->id) }}" method="post">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-outline-dark btn-sm">Supprimer</button>
      </form>
      @endcan
    </div>
  </div>
</div>@endforeach

@endsection