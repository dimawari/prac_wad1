<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
</head>
<body>
    <h1>Create New Post</h1>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div>
            <label for="body">Body:</label>
            <textarea name="body" id="body" required></textarea>
        </div>

        <button type="submit">Create Post</button>
    </form>

    <a href="{{ route('posts.index') }}">Back to Post List</a>

    <h1>All Posts</h1>

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    @foreach ($posts as $post)
        <div style="border: 1px solid #ddd; padding: 10px; margin-bottom: 10px;">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->body }}</p>
            <a href="{{ route('posts.edit', $post->id) }}" style="color: orange;">Edit</a>

            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" style="color: red;">Delete</button>
            </form>
        </div>
    @endforeach

    <a href="{{ route('posts.create') }}" style="color: green;">Create New Post</a>
</body>
</html>
 