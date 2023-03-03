@extends('sources.source')

@section('title')
All Categories
@endsection

@section('content')

@include('sources.navbar')

<div class="container content">
    <h1 style="text-align: center" class="mt-3 mb-3">All Categories</h1>
    <div class="mb-3">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h6>Add Category</h6>
                </div>
                <form action="{{ route('category.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" name="name" id="name">
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
                <th>Name</th>
                <th>Last Updated By</th>
                <th>Action</th>
            </thead>
            @php
                $i = 1;
            @endphp
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->users->name }}</td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('category.update.page', $category->id) }}"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a class="btn btn-danger" href="{{ route('category.delete', $category) }}"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
