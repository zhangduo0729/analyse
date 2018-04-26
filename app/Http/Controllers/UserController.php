<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * 用户列表
     * get:/users
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', [
            'users'=> $users
        ]);
    }
}
