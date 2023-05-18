<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private $user;

    public function __construct(Request $request) {
        $this->user = $request->user();
    }

    public function index() {
        return response()->json($this->user);
    }

    public function show() {
        return response()->json($this->user);
    }

    public function update(Request $request) {

        $this->user->fill($request->all());

        validateOrFail([
            'name' => 'required',
            'email' => [
                'required', 
                'email',
                Rule::unique('users')->ignore($this->user->id)
            ],
            'password' => 'prohibited',
        ], $this->user->toArray());

        $this->user->save();

        return response()->json($this->user);
    }
}
