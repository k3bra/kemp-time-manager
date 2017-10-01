<?php

namespace App\Http\Controllers;

use App\UserNotification;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;


class UserNotificationController extends Controller
{

    /**
     * ProjectController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getUserNotifications()
    {
        return (new UserNotification())->getNotSeenUserNotifications(auth()->user()->id);
    }

    public function showUserNotifications()
    {
        $notifications = (new UserNotification())->getUserNotifications(auth()->user()->id);

        return view('notification.index', [
            'notifications' => $notifications
        ]);
    }

}
