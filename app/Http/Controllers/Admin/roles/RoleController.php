<?php

namespace App\Http\Controllers\Admin\roles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\roles\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $role;
    public function __construct(Role $roleModel)
    {
        $this->role = $roleModel;
    }

    public function index()
    {
        $roles = $this->role::select("id", "name", "permissions","created_at")->get();
        return view('Dashboard.roles.list', compact('roles'));
    }

    public function create()
    {
        return view('Dashboard.roles.create');
    }
    public function store(RoleRequest $request)
    {
        $permissions = json_encode($request->permissions);
        $this->role::create([
            "name"=>$request->name,
            "permissions"=>$permissions
        ]);
        toast("Role created successfully","success");
        return to_route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        return view('Dashboard.roles.edit', compact('role'));
    }
    public function update(RoleRequest $request, Role $role)
    {
        $permissions = json_encode($request->permissions);
        $role->update([
            "name"=>$request->name,
            "permissions"=>$permissions
        ]);
        toast("Role updated successfully","success");
        return to_route('admin.roles.index');
    }

    public function destroy(Request $request)
    {
        $role = $this->role::findOrFail($request->id);

        // Check if the role is assigned to any admins
        if ($role->admins()->exists()) {
            toast("This role cannot be deleted because it is assigned to one or more admins.", "error");
            return to_route('admin.roles.index');
        }

        $role->delete();
        toast("Role deleted successfully.", "success");
        return to_route('admin.roles.index');
    }

}
