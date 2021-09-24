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
    <div>



        <form action="{{route('comment.store')}}" method="post">
            @csrf
        <label for="content">Répondre a ce message</label>
        <input type="text" id="content" name="content">
        <input type="hidden" name="message_id" value="{{ $message->id }}">
        <button type="submit" class="btn btn-outline-dark btn-sm">Poster votre réponse</button>
    </form>
</div>
</div>

@foreach($message->comments as $comment)

<!-- Affichage du comentaire -->
<div class="display-comment">
    <div>
        <p>posté par : <strong>{{ $comment->user->pseudonyme }}</strong>, le {{ $comment->created_at }}</p>
        <div class="d-flex">
            <p id="commentaire">{{ $comment->content }}</p>
        </div>
    </div>
    <div>
        @can('update', $comment)
        <a href="{{ route('comment.edit', $comment->id) }}" class="btn btn-outline-dark btn-sm">Editer</a>
        @endcan
        @can('delete', $comment)
        <form method="POST" action="{{ route('comment.destroy', $comment->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-dark btn-sm">Supprimer</i></button>
            </form>
        @endcan

    </div>

</div>
@endforeach

@endsection