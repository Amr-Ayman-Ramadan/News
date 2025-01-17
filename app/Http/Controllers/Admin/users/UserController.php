<?php

namespace App\Http\Controllers\Admin\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\UserRequest;
use App\Http\Traits\FileUploader;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use FileUploader;
    private $user;
    public function __construct(User $userModel)
    {
        $this->user = $userModel;
//        $this->middleware("can:users")->except("index");
    }

    public function index()
    {
            $users = $this->user::when(request()->keyword,function ($query){
                $query->where('username','like','%'.request()->keyword.'%')
                    ->orWhere('email','like','%'.request()->keyword.'%');
            })->when(request()->status,function ($query){
                $query->where('status',request()->status);
            })
                ->orderBy(request("sort_by",'id'),request("order_by","desc"))
                ->paginate(request('limit_by',10));
        return view('Dashboard.users.list', compact('users'));
    }


    public function create()
    {
        return view('Dashboard.users.create');

    }


    public function store(UserRequest $request)
    {

        $image = $this->uploadFile($request->file('image'),$this->user::PATH);

        $this->user::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'status' => $request['status'],
            'country' => $request['country'],
            'city' => $request['city'],
            'street' => $request['street'],
            'image' => $image
        ]);
        toast("User created successfully!","success");
        return to_route('admin.users.index');
    }



    public function show(User $user)
    {
        return view('Dashboard.users.show', compact('user'));
    }


    public function edit(User $user)
    {
        return view('Dashboard.users.edit', compact('user'));
    }


    public function update(UserRequest $request, User $user)
    {
        $image = $request->hasFile("image") ? $this->uploadFile($request->file("image"),$this->user::PATH,$this->user::PATH.DIRECTORY_SEPARATOR. $user->getRawOriginal('image')) : $user->getRawOriginal('image');
        $user->update([
            'name' => $request['name'],
            'username' => $request['username'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'status' => $request['status'],
            'country' => $request['country'],
            'city' => $request['city'],
            'street' => $request['street'],
            'image' => $image
        ]);
        toast("User updated successfully!","success");
        return to_route('admin.users.index');
    }


    public function destroy(string $id)
    {
        $user = $this->user::findOrFail($id);
        $this->deleteFile($this->user::PATH.DIRECTORY_SEPARATOR.$user->getRawOriginal('image'));
        $user->delete();
        toast("User Deleted!","success");
        return to_route('admin.users.index');
    }
    public function changeStatus($id)
    {
        $user = $this->user::findOrFail($id);
        if($user->status == "active")
        {
            $user->update(['status' => "inactive"]);
            toast("User Blocked!","success");
        }else{
            $user->update(['status' => "active"]);
            toast("User Actived!","success");
        }
        return to_route('admin.users.index');
    }
}
