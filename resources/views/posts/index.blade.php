<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post List</title>
</head>
<body>

    <h1>Your Posts</h1>

    <a href="{{ route('posts.create') }}" style="color: green;">Create New Post</a>

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    @if ($posts->count())
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
    @else
        <p>No posts found.</p>
    @endif

</body>
</html>
