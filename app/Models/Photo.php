<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['title', 'path'];


    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
