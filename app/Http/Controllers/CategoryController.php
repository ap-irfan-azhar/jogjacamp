<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Category;
use \App\Notifications\CategoryChanged;
use \App\Models\User;

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
            $category = Category::create($request->all());
            $users = User::all();
            $changedBy = auth()->user();
            foreach ($users as $user) {
                $user->notify(new CategoryChanged($user, $changedBy, $category, 'created'));
            }
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
            $users = User::all();
            $changedBy = auth()->user();
            foreach ($users as $user) {
                $user->notify(new CategoryChanged($user, $changedBy, $category, 'updated'));
            }
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
            $cat = $category;
            $category->delete();
            $users = User::all();
            $changedBy = auth()->user();
            foreach ($users as $user) {
                $user->notify(new CategoryChanged($user, $changedBy, $cat, 'deleted'));
            }
            return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
    }
}
