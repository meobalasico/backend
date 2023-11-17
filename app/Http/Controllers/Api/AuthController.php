<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

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
     * Login using the specified resource.
     */
    public function logout()
    {
        return false;
    }

}
