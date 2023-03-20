<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function create()
    {
        return view('categories.create');
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
            return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'is_published' => 'required',
        ]);

        $error = false;
        $message = 'Category updated successfully.';
        try {
            $category->update($request->all());
            return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
    }

    public function destroy(Category $category)
    {
        $error = false;
        $message = 'Category deleted successfully.';
        try {
            $category->delete();
            return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
    }
}
