@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h3>Modifier votre message</h3>
        </div>
    </div>
    <div class="row">
        <form action="{{ route('comment.update', $comment->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="col mb-3">
                <label for="image" class="form-label">Image du lieu</label>
                <input type="file" class="form-control" id="image" name="image" value="{{$comment->image}}" required>
            </div>
            <div class="col mb-3">
                <label for="content" class="form-label">Courte description de votre image</label>
                <input type="text" class="form-control" id="content" name="content" value="{{$comment->content}}" required>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>
    </div>
</div>

@endsection