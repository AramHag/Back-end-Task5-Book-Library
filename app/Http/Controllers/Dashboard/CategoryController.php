<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function index()
    {
        $categories = Category::with('parent')->get();
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.categories.add', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('category.index')->with('success' , 'New category is added');
    }

    public function edit(Category $category)
    {
        
        $categories = Category::where('id' ,'<>' ,  $category->id)->get();
        return view('dashboard.categories.edit',  compact('category' , 'categories'));
    }

    public function update(CategoryRequest $request , Category $category)
    {
        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('category.index')->with('success', 'The category is updated');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('danger', 'The category is deleted');
    }
}
