<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate(["search" => "required|string|max:255"]);
        $keyword = strip_tags($request->search);

        $posts = Post::active()->where("title","LIKE",'%'.$keyword.'%')
            ->orWhere("description","LIKE",'%'.$keyword.'%')->paginate(15);

        return view("EndUser.search",compact("posts"));
    }
}
