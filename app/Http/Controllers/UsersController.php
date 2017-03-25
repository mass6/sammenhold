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
                'name'       => $request->name,
                'email'      => $request->email,
                'password'   => bcrypt('unity'),
                'phone'      => $request->get('phone'),
                'is_patient' => $request->get('is_patient', false),
            ]);
        } catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => $user->toArray()], 201);

        return response()->json($request->all());
    }
}
