<?php

namespace App\Http\Controllers\Admin\posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\posts\PostRequest;
use App\Http\Traits\FileUploader;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use FileUploader;
    private $post, $category, $user;
    public function __construct(Post $postModel, Category $categoryModel, User $userModel)
    {
        $this->post = $postModel;
        $this->category = $categoryModel;
        $this->user = $userModel;
        $this->middleware("can:posts");
    }
    public function index()
    {
        $posts = $this->post::when(request()->keyword, function ($query) {
                $query->where('title', 'like', '%' . request()->keyword . '%');
            })
            ->when(request()->status, function ($query) {
                $query->where('status', request()->status);
            })

            ->orderBy(request("sort_by",'id'),request("order_by","desc"))
            ->paginate(request('limit_by',10));
        return view('Dashboard.posts.list', compact('posts'));
    }
    public function show(Post $post)
    {
        return view('Dashboard.posts.show', compact('post'));
    }
    public function create()
    {
        $categories = $this->category::select(['id','name'])->get();
        $users = $this->user::select(['id','name'])->get();
        return view('Dashboard.posts.create', compact('categories','users'));
    }
    public function store(PostRequest $request)
    {
        $image = $this->uploadFile($request->image, $this->post::PATH);
        $this->post::create([
            "title"=>$request->get('title'),
            "description"=>$request->get('description'),
            "category_id"=>$request->get('category_id'),
            "user_id"=>$request->get('user_id'),
            "status"=>$request->get('status'),
            "comment_able"=>$request->get('comment_able'),
            "image"=>$image,
        ]);
        toast("Post created successfully","success");
        return to_route('admin.posts.index');
    }
    public function edit(Post $post)
    {
        $categories = $this->category::select(['id','name'])->get();
        $users = $this->user::select(['id','name'])->get();
        return view('Dashboard.posts.edit', compact('post','categories','users'));
    }
    public function update(PostRequest $request, Post $post)
    {
       $image = $request->hasFile("image") ? $this->uploadFile($request->image,$this->post::PATH,$post->getRawOriginal("image")) : $post->getRawOriginal("image");
       $post->update([
           "title"=>$request->get('title'),
           "description"=>$request->get('description'),
           "category_id"=>$request->get('category_id'),
           "user_id"=>$request->get('user_id'),
           "status"=>$request->get('status'),
           "comment_able"=>$request->get('comment_able'),
           "image"=>$image,
       ]);
       toast("Post updated successfully","success");
       return to_route('admin.posts.index');
    }
    public function destroy (Request $request)
    {
        $post = $this->post::find($request->id);
        $this->deleteFile($this->post::PATH .DIRECTORY_SEPARATOR. $post->getRawOriginal('image'));
        $post->delete();
        toast("Post deleted successfully","success");
        return back();
    }
}
