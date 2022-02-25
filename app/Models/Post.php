<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'image' => 'object',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function incrementReadCount()
    {
        $this->reads++;
        return $this->save();
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->where('approved', 1)->whereNull('parent_id');
    }

    // scopes
    /**
     * Scope a query to only include publish posts
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'PUBLISHED');
    }
}
