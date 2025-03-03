<?php

namespace App\Http\Controllers\EndUser\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\EndUser\Post\PostRequest;
use App\Http\Traits\FileUploader;
use App\Models\Post;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class ProfileController extends Controller
{
    use FileUploader;
    public function index()
    {
        $posts = auth()->user()->posts()->with(['images'])->latest()->get();
        return view('EndUser.dashboard.profile', compact('posts'));
    }
    public function store(PostRequest $request)
    {
        try {
            DB::beginTransaction();

            $comment_able = $request->comment_able == "on" ? 1 : 0;

            // Create the post
            $post = Post::create([
                "title" => $request->title,
                "description" => $request->description,
                "category_id" => $request->category_id,
                "comment_able" => $comment_able,
                "user_id" => Auth::id(),
            ]);

            ImageManger::uploadImages($request, $post);
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
        toast("Post Added Successfully", "success");
        return back();
    }

    public function  edit(Post $post)
    {
        return view('EndUser.dashboard.profile.edit', compact('post'));
    }

    public function destroy(Request $request)
    {
        $post = Post::where("slug",$request->slug)->first();
        ImageManger::deleteImages($post);
        $post->delete();
        toast("Post Deleted Successfully", "success");
        return back();
    }
}
