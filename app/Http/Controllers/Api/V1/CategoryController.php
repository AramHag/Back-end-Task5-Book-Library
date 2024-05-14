<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    

    // =================== Getting All categories ===========
    public function index()
    {
        $categories = Category::with('parent')->get();
        return response()->json([
            'data' => $categories,
            'code' => 200,
            'message' => "Return All The categories with The parent category",
        ]);
    }
    
    
    // =================== Store new category ===========
    public function store(CategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);
        
        return response()->json([
            'data' => $category,
            'code' => 201,
            'message' => "New $category->name Category is added",
        ]);
    }
    
    
    // =================== Store new category ===========
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::where('id' , $id)->first();
        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

        return response()->json([
            'data' => $category,
            'code' => '200' ,
            'message' => "The category $category->name is update",
        ]);
    }

    // ================== Delete Category ==============

    public function destroy(string $id)
    {
        $category = Category::where('id' , $id)->first();
        $category->delete();
        return response()->json([
            'data' => $category,
            'code' => '200' ,
            'message' => "The category $category->name is deleted",
        ]);
    }
}
