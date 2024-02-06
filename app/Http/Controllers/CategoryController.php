<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;




class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    public function create()
    {
        return view('admin.addCategory');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Add validation rules for other attributes
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories')
            ->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id); // Retrieve the category by its ID
        
        return view('admin.editCategory', compact('category'));
    }
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Add validation rules for other attributes
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories')
            ->with('success', 'Category updated successfully');
    }

    // public function destroy($id)
    // {
    //     $category = Category::findOrFail($id);
    
    //     if ($category->cars()->exists()) {
    //         return redirect()->route('admin.categories')
    //             ->with('error', 'Category cannot be deleted because it has associated cars.');
    //     }
        
    //     $category->delete();
        
    //     return redirect()->route('admin.categories')
    //         ->with('success', 'Category deleted successfully');
    // }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->cars()->exists()) {
            return redirect()->route('admin.categories')->with('error', 'Category cannot be deleted because it has associated cars.');
        }

        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully');
    }
    
}