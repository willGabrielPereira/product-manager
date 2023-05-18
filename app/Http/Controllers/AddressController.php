<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    private $address;
    private $user;

    public function __construct(Request $request, Address $address)
    {
        $this->user = $request->user();
        $this->address = $address;
    }

    public function index() {
        return $this->address->all();
    }

    public function show($id) {
        return $this->address->find($id);
    }

    public function store(Request $request) {
        validateOrFail([
            'type' => 'required',
            'phone' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
            'district' => 'required',
            'state' => 'required',
            'country' => 'required',
        ]);
       
        $address = $this->user->addresses()->create($request->all());

        return response()->json($address);
    }

    public function update(Request $request, $id) {
        $address = $this->user->addresses()->find($id);
        $address->fill($request->all());

        validateOrFail([
            'type' => 'required',
            'phone' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
            'district' => 'required',
            'state' => 'required',
            'country' => 'required',
        ], $address->toArray());

        $address->save();

        return response()->json($address);
    }

    public function destroy($id) {
        $this->user->addresses()->find($id)->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
