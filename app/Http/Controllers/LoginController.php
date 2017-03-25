<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (auth()->attempt(['email' => $request->email, 'password' => 'unity'])) {
            $user = auth()->user();
            return response()->json(['data' => [
                "id"         => $user->id,
                "name"       => $user->name,
                "email"      => $user->email,
                "phone"      => $user->phone,
            ]]);
        }

        return response()->json(['result' => 'authentication failed']);
    }
}
