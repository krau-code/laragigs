<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // Allowing Mass Assignment OR the method in app/Providers/AppServiceProvider.php
    // protected $fillable = ['title', 'company', 'location', 'website', 'location', 'email', 'description', 'tags'];

    // Filter
    public function scopeFilter($query, array $filters) {
        if ($filters['tag'] ?? false) { //?? is null coalescing operator. If filters tag is not false, execute code
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                  ->orWhere('description', 'like', '%' . request('search') . '%')
                  ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    // Relationship To User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
