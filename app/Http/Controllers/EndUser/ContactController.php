<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\EndUser\Contact\ContactRequest;
use App\Models\Admin;
use App\Models\Contact;
use App\Notifications\NewContactNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function index()
    {
        return view('EndUser.contact');
    }
    public function store(ContactRequest $request)
    {
        $request->merge([
            "ip_address"=>$request->ip()
        ]);
        $contact = Contact::create($request->all());
        toast("Contact created successfully","success");
        $admin = Admin::get();
        Notification::send($admin, new NewContactNotify($contact));
        return back();
    }
}
