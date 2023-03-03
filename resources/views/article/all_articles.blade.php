@extends('sources.source')

@section('title')
All Articles
@endsection

@section('content')

@include('sources.navbar')


<div class="container content">
    <h1 style="text-align: center" class="mt-3 mb-3">All Articles</h1>
    <div class="mb-3">
        <div class="card">
            @php
                $categories = App\Models\Category::all();
            @endphp
            <div class="card-body">
                <div class="card-title"><h6>Add Article</h6></div>
                <form action="{{ route('article.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Write the article's title">
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category:</label>
                        <select name="category_id" id="category_id" class="form-control form-select">
                            <option value="" selected disabled>Select Category!</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content:</label>
                        <textarea class="form-control" name="content" id="content" rows="5" placeholder="Write the article's content"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="article_image" class="form-label">Image:</label>
                        <input type="file" name="article_image" id="article_image" class="form-control">
                    </div>
                    <button class="btn btn-info" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="mb-3 mt-3">
        <table class="table">
            <thead class="table-light">
                <th>No</th>
                <th>Title</th>
                <th>Category</th>
                <th width="40%">Content</th>
                <th>Last Updated By</th>
                {{-- <th>Last updated</th> --}}
                <th>Action</th>
            </thead>
            @php
                $i = 1;
            @endphp
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->categories->name }}</td>
                        <td>{{ $article->content }}</td>
                        <td>{{ $article->users->name }}</td>
                        {{-- <td>{{ date('d-m-Y', strtotime($article->updated_at)) }}</td> --}}
                        <td>
                            {{-- <a href="{{ route('categories.all') }}" class="btn btn-info">hehh</a> --}}
                            <a href="{{ route('article.update.page', $article->id) }}" class="btn btn-warning"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a href="{{ route('article.delete', $article) }}" class="btn btn-danger" ><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
