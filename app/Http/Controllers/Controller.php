<?php

namespace App\Http\Controllers;

use App\Models\User;

abstract class Controller
{
    public function show($id)
    {
        $users = User::with('profile')->findOrFail($id);
        return view('users.index',compact('users'));
    }
}
