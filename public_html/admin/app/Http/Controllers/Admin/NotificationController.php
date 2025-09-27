<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{


    public function index()
    {
        $notifications = Notification::where('notification_for', 'admin')->orderBy('id', 'DESC')->get();
        return view('notifications.index', compact('notifications'));
    }



// public function index()
// {
//     Notification::where('notification_for', 'admin')
//                 ->update(['seen' => 1]);
//     $notifications = Notification::where('notification_for', 'admin')->get();

//     return view('notifications.index', compact('notifications'));
// }

    public function toggleRead(Notification $notification)
    {
        $notification->seen = !$notification->seen;
        $notification->save();
        return back();
    }
    public function destroy(Notification $notification)
    {
        $notification->delete();
        return redirect()->route('notifications.index')->with('success', 'Notification deleted.');
    }
}
