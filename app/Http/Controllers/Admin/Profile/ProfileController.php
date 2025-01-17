<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(Admin $admin)
    {
        return view('Dashboard.profile.index', compact('admin'));
    }
    public function update(ProfileRequest $request)
    {
        $admin = Admin::find(auth()->user()->id);
        $admin->update([
            "name"=>$request->name,
            "username"=>$request->username,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
        ]);
        toast("Profile Updated Successfully!", "success");
        return to_route('admin.profile.index');
    }
}
