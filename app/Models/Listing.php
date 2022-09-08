<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    // We need to define this in order to submit the form and upload the data in the database
    // protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags'];

    public function scopeFilter($query, array $filters)
    {
        // filter using the tags
        if ($filters['tag'] ?? false) {
            // if there are some tags then filter them
            // Use the % symbol before and after the tag value to get any strings that contain this tag value
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        // filter using the search
        if ($filters['search'] ?? false) {
            // Search the titles or the description or the tages for the search value
            // Use the % symbol before and after the tag value to get any strings that contain this tag value
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    // Relationship To User - a listing belongs to user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
