<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'mail' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('US_EMAIL', $request->mail)->first();

        if ($user == null || !$user->checkPassword($request->password)) {
            return view('login', ['wrongPassword' => true]);
        }

        session(['user' => $user]);
        return redirect('/');
    }
}
