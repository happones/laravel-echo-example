<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth()->user();
            auth()->logout();

            $token = $user->createToken('app')->accessToken;
            return response([
                'token' => $token,
            ])->header('Authorization', $token);
        }
    }
}
