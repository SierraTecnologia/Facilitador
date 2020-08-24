<?php

namespace Facilitador\Test\Forms\Models;

use Illuminate\Database\Eloquent\Model;
use Siravel\Models\Blog\Post;

class Tag extends Model
{
    protected $fillable = ['name', 'slug'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
