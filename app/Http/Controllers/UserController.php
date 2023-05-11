<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        $validator = validateOrFail([
            'name' => 'required',
        ]);

        dd($validator);

        $this->user->fill($request->all());

        return response()->json($user);
    }
}
