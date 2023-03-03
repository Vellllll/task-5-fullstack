@extends('sources.source')

@section('title')
Update Article
@endsection

@section('content')

@include('sources.navbar')

<div class="container content">
    <h1 style="text-align: center" class="mt-3 mb-3">Update Article</h1>
    <div class="mb-3">
        <div class="card">
            @php
                $categories = App\Models\Category::all();
            @endphp
            <div class="card-body">
                <div class="card-title">
                    <h6>Update Article</h6>
                </div>
                <form action="{{ route('article.update', $article) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Write the article's title" value="{{ $article->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category:</label>
                        <select name="category_id" id="category_id" class="form-control form-select">
                            @foreach ($categories as $category)
                                <option value="{{  $category->id }}" {{ $article->categories->id == $category->id ? 'selected' : '' }} >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content:</label>
                        <textarea class="form-control" name="content" id="content" rows="5" placeholder="Write the article's content">{{ $article->content }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image:</label>
                        <input name="image" id="image" type="file" class="form-control" value="{{ $article->image }}">
                    </div>
                    <button class="btn btn-info" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
