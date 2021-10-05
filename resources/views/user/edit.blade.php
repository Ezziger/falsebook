@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
  <div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="file" class="form-control" id="image" name="image" value="{{ $user->image }}">
  </div>
  <div class="mb-3">
    <label for="nom" class="form-label">Nom</label>
    <input type="text" class="form-control" id="nom" name="nom" value="{{ $user->nom }}">
  </div>
  <div class="mb-3">
    <label for="prenom" class="form-label">Prenom</label>
    <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $user->prenom }}">
  </div>
  <div class="mb-3">
    <label for="pseudonyme" class="form-label">Pseudo</label>
    <input type="text" class="form-control" id="pseudonyme" name="pseudonyme" value="{{ $user->pseudonyme }}">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
  </div>
  <button type="submit" class="btn btn-primary">Modifier vos informations personnelles</button>
</form>

<form action="{{ route('user.updatePassword', $user->id) }}" method="POST">
  @csrf
  @method('PATCH')
  <div class="mb-3">
    <label for="oldPassword" class="form-label">Votre mot de passe actuel</label>
    <input type="password" class="form-control" id="oldPassword" name="oldPassword" required>
  </div>
  <div class="mb-3">
    <label for="newPassword" class="form-label">Votre nouveau mot de passe</label>
    <input type="password" class="form-control" id="newPassword" name="newPassword" required>
  </div>
  <div class="mb-3">
    <label for="newPassword_confirmation" class="form-label">Confirmez votre nouveau mot de passe</label>
    <input type="password" class="form-control" id="newPassword_confirmation" name="newPassword_confirmation" required>
  </div>
  <button type="submit" class="btn btn-primary">Modifier votre mot de passe</button>
</form>
<form action="{{ route('user.destroy', $user->id) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit">Supprimer votre profil</button>
</form>

@endsection