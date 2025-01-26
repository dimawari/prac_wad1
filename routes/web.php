<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Ensure routes are grouped with 'auth' middleware
Route::middleware('auth')->group(function () {
    // Display all posts
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

    // Show form to create a new post
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

    // Store new post
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // Show form to edit a post
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

    // Update an existing post
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

    // Delete a post
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});
