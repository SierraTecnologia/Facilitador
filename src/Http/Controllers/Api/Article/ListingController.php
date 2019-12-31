<?php

namespace Facilitador\Http\Controllers\Articles\Api;

use App\Models\User;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingController extends Controller
{
    public function tags()
    {
        $tags = Tag::paginate(10);

        return $tags;
    }

    public function categories()
    {
        $categories = Category::paginate(10);

        return $categories;
    }

    public function users()
    {
        $users = User::paginate(10);

        return $users;
    }
}
