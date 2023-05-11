<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
}
