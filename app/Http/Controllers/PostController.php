<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Display a listing of the posts for the authenticated user
    public function index()
    {
        $posts = Auth::user()->posts; // Get posts belonging to the authenticated user
        return view('posts.index', compact('posts'));
    }

    // Show the form for creating a new post
    public function create()
    {
        return view('posts.create');
    }

    // Store a newly created post in the database
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Create the post associated with the authenticated user
        Auth::user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully!');
    }

    // Show the form for editing the specified post
    public function edit(Post $post)
    {
        // Check if the authenticated user is the owner of the post
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized');
        }

        return view('posts.edit', compact('post'));
    }

    // Update the specified post in the database
    public function update(Request $request, Post $post)
    {
        // Check if the authenticated user is the owner of the post
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized');
        }

        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Update the post
        $post->update($request->all());

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully!');
    }

    // Remove the specified post from the database
    public function destroy(Post $post)
    {
        // Check if the authenticated user is the owner of the post
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized');
        }

        // Delete the post
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully!');
    }
}
