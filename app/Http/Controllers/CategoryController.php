<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Request $request, Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        return $this->category->all();
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function store(Request $request)
    {
        validateOrFail([
            'description' => 'required',
        ]);

        $category = $this->category->create($request->all());

        return response()->json($category);
    }

    public function update(Request $request, Category $category)
    {
        $category->fill($request->all());

        validateOrFail([
            'description' => 'required',
        ], $category->toArray());

        $category->save();

        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
