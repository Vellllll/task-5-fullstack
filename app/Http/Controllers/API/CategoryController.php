<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return $this->showAll($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categories = Category::all();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation error.', $validator->errors());
        }

        foreach($categories as $category){
            if($category->name == $request->name){
                return $this->errorResponse('This category is already exists!', 422);
            }
        }

        $category = Category::create([
            'name' => $request->name,
            'user_id' => $request->user()->id,
        ]);

        return $this->showOne($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->showOne($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->fill($request->only([
            'name',
        ]));

        if(!$category->isDirty()){
            return $this->errorResponse('Please give a different value to update!', 422);
        }

        $categories = Category::all();

        foreach($categories as $cat){
            if($cat->name == $request->name){
                return $this->errorResponse('This category is already exist!', 422);
            }
        }

        $category->save();
        return $this->showOne($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->showOne($category);
    }
}
