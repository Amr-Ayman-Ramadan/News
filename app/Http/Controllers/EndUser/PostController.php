<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\EndUser\Comment\CommentRequest;
use App\Models\Comment;
use App\Models\Post;


class PostController extends Controller
{
    public function show($slug)
    {
        $post = Post::active()->with(["comments"=>function ($query) {
            $query->latest()->limit(3);
        }])->whereSlug($slug)->firstOrFail();
        $category = $post->category;
        $posts_belongs_to_category = $category->posts()->select("id","title","image","slug")->limit(5)->get();
        return view('EndUser.show-post', compact('post','posts_belongs_to_category'));
    }
    public function getAllComments($slug)
    {
        $post = Post::whereSlug($slug)->firstOrFail();
        $comments = $post->comments()->with('user')->get();
        return response()->json($comments);
    }
    public function storeComment(CommentRequest $request)
    {
       $comment = Comment::create([
            "user_id" => $request->user_id,
            "post_id" => $request->post_id,
            "comment" => $request->comment,
            "ip_address" => $request->ip()
        ]);
       $comment->load('user');
        return response()->json([
            "message" => "Comment added successfully!",
            "data"=> $comment,
            "status" => 200
        ]);
    }
}
