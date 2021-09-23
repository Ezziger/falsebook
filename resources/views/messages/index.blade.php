@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="span4 well" style="padding-bottom:0">
            <form class="d-flex flex-column" action=" {{ route('messages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="content">Message</label>
                <textarea class="" id="content" name="content" rows="3"></textarea>
                <label for="image">Image</label>
                <input type="file" id="image" name="image">
                <h6 class="pull-right">320 characters remaining</h6>
                <button class="btn btn-info" type="submit">Poster votre message</button>
            </form>
        </div>
	</div>
</div>
<h2>Derniers messages postés</h2>

@foreach($messages as $message)
<div class="card">
  <div class="card-header">
    Quote
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p>{{ $message->content }}</p>
      <footer class="blockquote-footer">Posté par : {{ $message->user->pseudonyme }} le {{ $message->created_at }}</footer>
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
@endforeach

{{ $messages->links() }}

@endsection