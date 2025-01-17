<?php

namespace App\Http\Controllers\Admin\admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\admins\AdminRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $admin;
    private $role;
    public function __construct(Admin $adminModel, Role $roleModel)
    {
        $this->admin = $adminModel;
        $this->role = $roleModel;
        $this->middleware("can:admins");
    }

    public function index()
    {
        $admins = $this->admin::with('roles:id,name')
            ->where("role_id", "!=", auth()->user()->role_id)
            ->when(request()->keyword, function ($query) {
            $query->where('name', 'like', '%' . request()->keyword . '%')
                ->orWhere('email', 'like', '%' . request()->keyword . '%')
                ->orWhere('username', 'like', '%' . request()->keyword . '%');
        })
            ->when(request()->status, function ($query) {
                $query->where('status', request()->status);
            })
            ->orderBy(request("sort_by", 'id'), request("order_by", "desc"))
            ->paginate(request('limit_by', 10));

        return view('Dashboard.admins.list', compact('admins'));
    }

    public function create()
     {
         $roles = $this->role::select('id','name')->get();
         return view('Dashboard.admins.create', compact('roles'));
     }
     public function store(AdminRequest $request)
     {
         $this->admin::create([
             "name"=>$request->name,
             "username"=>$request->username,
             "email"=>$request->email,
             "password"=>bcrypt($request->password),
             "status"=>$request->status,
             "role_id"=>$request->role_id
         ]);
         toast("Admin created successfully","success");
         return to_route('admin.admins.index');
     }
     public function edit(Admin $admin)
     {
         $roles = $this->role::select('id','name')->get();
         return view('Dashboard.admins.edit', compact('admin','roles'));
     }
     public function update(AdminRequest $request, Admin $admin)
     {
        $admin->update([
                "name"=>$request->name,
                "username"=>$request->username,
                "email"=>$request->email,
                "password"=>bcrypt($request->password),
                "status"=>$request->status,
                "role_id"=>$request->role_id
        ]);
        toast("Admin updated successfully","success");
        return to_route('admin.admins.index');
     }

     public function destroy(Request $request)
     {
        $admin = $this->admin::findOrFail($request->id);
        $admin->delete();
        toast("Admin deleted successfully","success");
        return to_route('admin.admins.index');
     }
}
