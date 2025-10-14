<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        return view('category.index', [
            'categories' => $categories,
        ]);
    }

    public function create(Request $request)
    {
        return view('category.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create($request->validated());
        session()->flash('success', 'Registro creado exitosamente');
        return redirect()->route('categories.index');
    }

    public function edit(Request $request, Category $category)
    {
        return view('category.edit', [
            'category' => $category,
        ]);
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->validated());
        session()->flash('success', 'Registro modificado exitosamente');
        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success', 'Registro eliminado exitosamente');
        return redirect()->route('categories.index');
    }
}
