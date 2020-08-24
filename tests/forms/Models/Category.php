<?php

namespace Facilitador\Test\Forms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Siravel\Models\Blog\Post;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
