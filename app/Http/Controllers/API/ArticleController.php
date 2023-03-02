<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArticleController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();
        return $this->showAll($articles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation error.',$validator->errors());
        }

        $categories = Category::all();

        foreach($categories as $category){
            if($request->category_id == $category->id){
                if($request->image == null){
                    $article = Article::create([
                        'title' => $request->title,
                        'content' => $request->content,
                        'image' => 'no_image',
                        'user_id' => $request->user()->id,
                        'category_id' => $request->category_id,
                    ]);

                    return $this->showOne($article, 201);
                } else {
                    $article = Article::create([
                        'title' => $request->title,
                        'content' => $request->content,
                        'image' => $request->image,
                        'user_id' => $request->user()->id,
                        'category_id' => $request->category_id,
                    ]);
                    return $this->showOne($article, 201);
                }
            }
        }

        return $this->errorResponse('No category match!', 404);

    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return $this->showOne($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $article->fill($request->only([
            'title',
            'content',
        ]));

        if(!$article->isDirty()){
            return $this->errorResponse('Please give a different value to update!', 422);
        };

        $article->save();
        return $this->showOne($article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return $this->showOne($article);
    }
}
