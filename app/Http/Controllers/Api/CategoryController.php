<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::query();
        $page = $request->get('page', 1);
        $perPage = $request->get('per_page', 10);

        if ($request->has('q')) {
            $categories = $categories->search($request->get('q'));
        }

        if ($request->has('is_published')) {
            $categories = $categories->where('is_published', $request->get('is_published'));
        }

        $categories = $categories->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'error' => false,
            'data' => $categories,
        ]);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'error' => true,
                'message' => 'Category not found.',
            ]);
        }

        return response()->json([
            'error' => false,
            'data' => $category,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'is_published' => 'required',
        ]);

        $error = false;
        $message = 'Category created successfully.';
        try {
            Category::create($request->all());
        } catch (\Exception $e) {
            $error = true;
            $message = $e->getMessage();
        }

        return response()->json([
            'error' => $error,
            'message' => $message,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'is_published' => 'required',
        ]);

        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'error' => true,
                'message' => 'Category not found.',
            ]);
        }

        $error = false;
        $message = 'Category updated successfully.';
        try {
            $category->update($request->all());
        } catch (\Exception $e) {
            $error = true;
            $message = $e->getMessage();
        }

        return response()->json([
            'error' => $error,
            'message' => $message,
        ]);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'error' => true,
                'message' => 'Category not found.',
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Category deleted successfully.',
        ]);
    }
}
