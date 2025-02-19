<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\UserRegistered;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        event(new UserRegistered($user)); // Fire the event

        return response()->json(['message' => 'User registered successfully!']);
    }
}
