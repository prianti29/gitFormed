<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function readNotificationsAndUpdateReadStatus()
    {
        $user_id = Auth::id();
        Notification::where('user_id', $user_id)->update(['is_read' => true]);
        $user = Auth::user();
        $notifications = $user->notifications()->with('pullRequest')->latest()->get();
        return view('notification', compact('notifications'));
    }
}
