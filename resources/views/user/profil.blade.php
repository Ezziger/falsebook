@extends('layouts.app')

@section('content')
<h1>Votre super profil</h1>

<img src="{{$user->image}}" alt="Avatar de l'utilisateur {{$user->pseudonyme}}">
<h2>Nom : {{$user->nom}}</h2>
<h2>Prenom : {{$user->prenom}}</h2>
<h2>Pseudo : {{$user->pseudonyme}}</h2>
<h2>Email : {{$user->email}}</h2>
<h2>Mot de passe : </h2>

<a href="{{route('user.edit', $user->id)}}" class="btn btn-outline-dark btn-sm">Editer</a>

@endsection