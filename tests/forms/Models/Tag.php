<?php

namespace Facilitador\Test\Forms\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Post;

class Tag extends Model
{
    protected $fillable = ['name', 'slug'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
