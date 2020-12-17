<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;


class CategoryController extends Controller
{
    // Show form to create new category (admin only)
    public function create()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect();
        } else {
            return view('categories/create');
        }
    }

    // Save new category (admin only)
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:32'],
            'title' => ['required', 'min:3', 'max:32'],
            'status' => ['required', 'in:' . join(',', Category::POSSIBLE_STATUSES)]
        ]);

        $category = new Category;
        $category->name = $request->input('name');
        $category->title = $request->input('title');
        $category->status = $request->input('status');
        $category->updated_at = null;
        $category->save();

        return redirect('users/' . Auth::id())->with('success', 'New Category added succesfully!');
    }

    // Show all articles for category
    public function show($id)
    {
        $category = Category::find($id);
        $articles = $category->articles()->orderBy('created_at', 'desc')->paginate(5);

        return view('/categories/index')
            ->with('category', $category)
            ->with('articles', $articles);

    }

    // Edit category form (admin only)
    public function edit(Category $category)
    {
        return view('categories.edit')
            ->with('category', $category);
    }

    // Save category to database (admin only)
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:32'],
            'title' => ['required', 'min:3', 'max:32'],
            'status' => ['required', 'in:' . join(',', Category::POSSIBLE_STATUSES)]
        ]);

        $category->name = $request->input('name');
        $category->title = $request->input('title');
        $category->status = $request->input('status');
        $category->save();

        return redirect('users/' . Auth::id())->with('success', 'Category edited succesfully!');
    }
}
