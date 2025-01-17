<?php

namespace App\Http\Controllers\Admin\categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    private $category;
    public function __construct(Category $categoryModel)
    {
        $this->category = $categoryModel;
    }
    public function index()
    {
        $categories = $this->category::withCount('posts')
            ->when(request()->keyword, function ($query) {
                $query->where('name', 'like', '%' . request()->keyword . '%');
            })
            ->when(request()->status, function ($query) {
                $query->where('status', request()->status);
            })

        ->orderBy(request("sort_by",'id'),request("order_by","desc"))
        ->paginate(request('limit_by',10));
        return view('Dashboard.categories.list', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $this->category::create([
            "name"=>$request->name,
            "status"=>$request->status
        ]);
        toast("Category created successfully","success");
        return back();
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update([
           "name"=>$request->name,
           "status"=>$request->status
        ]);
        toast("Category updated successfully","success");
        return back();
    }

    public function destroy(Category $category)
    {
        $category->delete();
        toast("category deleted successfully","success");
        return to_route('admin.categories.index');
    }
    public function changeStatus($id)
    {
        $category = $this->category::findOrFail($id);
        if($category->status == "active")
        {
            $category->update(['status' => "inactive"]);
            toast("Category Blocked!","success");
        }else{
            $category->update(['status' => "active"]);
            toast("Category Actived!","success");
        }
        return to_route('admin.categories.index');
    }

}
