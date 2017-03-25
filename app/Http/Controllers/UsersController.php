<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function store(Request $request)
    {
        try {
            $user = User::create([
                'name'       => $request->get('name'),
                'email'      => $request->get('email'),
                'phone'      => $request->get('phone'),
                'password'   => bcrypt('unity'),
            ]);
        } catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => $user->toArray()], 201);
    }
}
