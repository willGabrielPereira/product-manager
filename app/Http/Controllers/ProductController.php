<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;

    public function __construct(Request $request, Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        return $this->product->all()->load('categories');
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function store(Request $request)
    {
        validateOrFail([
            'title' => 'required',
            'price' => ['required', 'double'],
            'amount' => ['required', 'double'],
        ]);

        $product = $this->product->create($request->all());

        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $product->fill($request->all());

        validateOrFail([
            'title' => 'required',
            'price' => ['required', 'double'],
            'amount' => ['required', 'double'],
        ], $product->toArray());

        $product->save();

        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
