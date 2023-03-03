@extends('sources.source')

@section('title')
Update Category
@endsection

@section('content')

@include('sources.navbar')

<div class="container content">
    <h1 style="text-align: center" class="mt-3 mb-3">Update Category</h1>
    <div class="mb-3">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h6>Update Category</h6>
                </div>
                <form action="{{ route('category.update', $category) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Write the article's title" value="{{ $category->name }}">
                    </div>
                    <button class="btn btn-info" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
