@extends('sources.source')

@section('title')
Home
@endsection

@section('content')

<style>
    .welcome {
        padding-top: 120px;
        text-align: center;
    }

    .logout {
        color: black;
    }
</style>

@include('sources.navbar')

<div class="container welcome mb-5">
    <h1 style="font-weight: 200">Welcome to Dashboard Page!</h1>
    <p>Please click the navigation bar to see the features!</p>
    <br>
    @if (Auth::user() != null)
    <p>You're logged in!</p>
    <a href="{{ route('logout') }}" class="logout">Click here to logout</a>
    @endif
</div>

<div class="container">
    @php
        $categories = App\Models\Category::all();
    @endphp
    @foreach ($categories as $category)
        <h4>Category: {{ $category->name }}</h4>
        <table class="table">
            <thead class="table-light">
                <th>No</th>
                <th>Article's Title</th>
                <th>Content</th>
                <th>Last Updated By</th>
            </thead>
            @php
                $articles = App\Models\Article::where('category_id', $category->id)->get();
            @endphp
            <tbody>
                @if ($articles->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">No Article!</td>
                    </tr>
                @else

                @foreach ($articles as $key => $article)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $article->title }}</td>
                        <td width="60%">{{ $article->content }}</td>
                        <td>{{ $article->users->name }}</td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        <br>
    @endforeach
</div>


@endsection


{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
