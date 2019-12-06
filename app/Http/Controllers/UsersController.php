<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function notifications()
    {
        auth()->user()->unreadNotifications->markAsRead();


        return view('users.notifications')->with([
            'notifications'=> auth()->user()->notifications,
        ]);
    }
}
