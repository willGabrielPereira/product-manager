<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $payment;
    private $user;

    public function __construct(Request $request, Payment $payment)
    {
        $this->user = $request->user();
        $this->payment = $payment;
    }

    public function index()
    {
        return $this->payment->all();
    }

    public function show(Payment $payment)
    {
        return $payment;
    }

    public function store(Request $request)
    {
        validateOrFail([
            'type' => 'required',
        ]);

        $payment = $this->user->payments()->create($request->all());

        return response()->json($payment);
    }

    public function update(Request $request, $id)
    {
        $payment = $this->user->payments()->find($id);
        $payment->fill($request->all());

        validateOrFail([
            'type' => 'required',
        ], $payment->toArray());

        $payment->save();

        return response()->json($payment);
    }

    public function destroy($id)
    {
        $this->user->payments()->find($id)->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
