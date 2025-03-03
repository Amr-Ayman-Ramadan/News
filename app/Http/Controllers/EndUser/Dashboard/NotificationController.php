<?php

namespace App\Http\Controllers\EndUser\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return view("EndUser.dashboard.notification");
    }
    public function destroy(Request $request)
    {
        $notification = auth()->user()->notifications->where("id",$request->notification_id)->first();
        $notification->delete();
        toast()->success("Notification Deleted");
        return back();
    }
    public function markAsRead(Request $request)
    {
        auth()->user()->unreadNotifications->markAsRead();
        toast()->success("Notification marked as read");
        return back();
    }
}
