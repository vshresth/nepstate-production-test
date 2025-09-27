<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return  view('notifications.index', compact('notifications'));
    }
    public function toggleRead(Notification $notification)
    {
        $notification->read = !$notification->read;
        $notification->save();
        return back();
    }
    public function destroy(Notification $notification)
    {
        $notification->delete();
        return redirect()->route('notifications.index')->with('success', 'Notification deleted.');
    }
}
