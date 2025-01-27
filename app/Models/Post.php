<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Import for factory support
use App\Models\User; // Ensure the User model is imported for the relationship

class Post extends Model
{
    use HasFactory;

        protected $fillable = ['title', 'body', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor: Modify the title to always have the first letter capitalized
    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    // Mutator: Automatically set the title to lowercase before saving
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtolower($value);
    }

    // Query scope: Fetch posts by a specific user
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
