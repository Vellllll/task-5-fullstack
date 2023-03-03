<?php

namespace App\Http\Controllers;
use Intervention\Image\Facades\Image;

use Illuminate\Http\Request;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function allArticles(){
        $articles = Article::all();
        return view('article.all_articles')->with([
            'articles' => $articles,
        ]);
    }

    public function storeArticle(Request $request){
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ],[
            'title.required' => 'Please input the title!',
            'content.required' => 'Please input the content!',
            'category_id.required' => 'Please select the category!',
        ]);

        if($request->article_image == null){
            Article::insert([
                'title' => $request->title,
                'content' => $request->content,
                'image' => 'no_image',
                'category_id' => $request->category_id,
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
        } else {
            Article::insert([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'image' => $request->article_image,
            ]);
        }

        return redirect()->route('articles.all');
    }

    public function updateArticlePage($id){
        $article = Article::findOrFail($id);

        return view('article.update_article')->with([
            'article' => $article,
        ]);
    }

    public function updateArticle(Request $request, Article $article){
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ],[
            'title.required' => 'Please input the title!',
            'content.required' => 'Please input the content!',
            'category_id.required' => 'Please select the category!',
        ]);

        if($request->image == null){
            $article->update([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'user_id' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);
        } else {
            $article->update([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'image' => $request->image,
                'user_id' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);
        }

        return redirect()->route('articles.all');
    }

    public function deleteArticle(Article $article){

        $article->delete();
        return redirect()->back();
    }

}
