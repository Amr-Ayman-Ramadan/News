<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Mail\EndUser\NewSubscriberMail;
use App\Models\NewSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewSubscriberController extends Controller
{
    public function store(Request $request)
    {
      $validatedData = $request->validate(["email" => "required|email|unique:new_subscribers,email"]);
       NewSubscriber::create($validatedData);
       Mail::to($request->email)->send(new NewSubscriberMail());
        toast("You have successfully subscribed to our newsletter","success");
        return back();
    }
}
