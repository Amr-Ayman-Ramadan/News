<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Models\Category;


class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($slug)
    {
        $category = Category::whereSlug($slug)->select("id", "name", "slug")->firstOrFail();
       $posts = $category->posts()->select("id","title","slug")->latest()->paginate(5);
       return view('EndUser.category-posts',compact('posts'));
    }
}
