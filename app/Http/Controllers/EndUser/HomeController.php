<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
        public function index()
    {
        $posts = Post::latest()->paginate(5);
        $mostViewPosts = Post::orderBy("num_of_views", "desc")->limit(3)->get();
        $oldestPosts = Post::oldest()->limit(3)->get();
        $popularPosts = Post::withCount("comments")->orderBy("comments_count", "desc")->limit(3)->get();
        $latestPosts = Post::latest()->limit(3)->get();

        $categories = Category::with(['posts' => function ($query) {
            $query->limit(3)->with('images');
        }])->get();

        return view('EndUser.index', [
            'posts' => $posts,
            'mostViewPosts' => $mostViewPosts,
            'oldestPosts' => $oldestPosts,
            'popularPosts' => $popularPosts,
            'latestPosts' => $latestPosts,
            'categories_with_posts' => $categories,
        ]);
    }
}
