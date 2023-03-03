<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function allCategories(){
        $categories = Category::all();
        return view('category.all_categories')->with([
            'categories' => $categories
        ]);
    }

    public function storeCategory(Request $request){
        $request->validate([
            'name' => 'required|unique:categories,name',
        ],[
            'name.required' => 'Please input the category name!',
            'name.unique' => 'This category is already exists!',
        ]);

        Category::insert([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('categories.all');
    }

    public function updateCategoryPage($id){
        $category = Category::findOrFail($id);

        return view('category.update_category')->with([
            'category' => $category,
        ]);
    }

    public function updateCategory(Request $request, Category $category){
        $request->validate([
            'name' => 'required|unique:categories,name',
        ],[
            'name.required' => 'Please input the category name!',
            'name.unique' => 'This category is already exists!',
        ]);

        $category->update([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('categories.all');
    }

    public function deleteCategory(Category $category){
        $articles = Article::where('category_id', $category->id)->get();

        Article::destroy($articles);
        $category->delete();
        return redirect()->route('categories.all');
    }
}
