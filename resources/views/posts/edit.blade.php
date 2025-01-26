
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Post</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $post->title }}" required>
        </div>

        <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" class="form-control" id="body" required>{{ $post->body }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>

@endsection
