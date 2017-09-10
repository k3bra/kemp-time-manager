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


    public function all()
    {
        return UserNotification::with(['users'])->where('user_id', '=', Auth::user()->id)->get();
    }

    public function userNotSeen()
    {
        return UserNotification::with(['users'])->where('user_id', '=', Auth::user()->id)
            ->where('seen', '=', 0)->get();
    }

}
