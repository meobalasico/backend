<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    /**
     * Login using the specified resource.
     */
    public function login(UserRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $response = [
            'user' => $user,
            'token' => $user->createToken($request->email)->plainTextToken
        ];

        return $response;
    }

    /**
     * Logout using the specified resource.
     */
    public function logout(Request $request)
    {
        // Revoke the user's tokens
        $request->user()->tokens()->delete();


        $response = [
            'message' => 'Nawala na to imong token gi biyaan naka'
        ];

        return $response;
    }

}
