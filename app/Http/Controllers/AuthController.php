<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $auth;

    public function __construct(User $user) {
        return $this->auth = $user;
    }

    public function signup(Request $request) {
        $validator = validateOrFail([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create($validator->valid());

        $token = $user->createToken('token')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    public function signin(Request $request) {
        validateOrFail([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], $request->post());

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password))
            return throw new ApiException("Invalid login credentials", [], 401);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['access_token' => $token], 200);
    }
}
