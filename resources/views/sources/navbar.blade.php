@extends('sources.source')

<style>
nav {
    display: flex;
    align-items: center;
    justify-content:center;
    padding: 1.3em 18em;
    /* border: 1px white solid; */
    width: 100%;
    position: fixed;
    transition: all 0.25s ease-in-out;
    z-index: 100;
    background-color: rgb(235, 235, 235);
    height: 70px;
}

.nav-title {
    font-weight: 400;
    transition: all 0.25s ease-in-out;
}

.nav-title span {
    font-weight: 600;
}

.nav-list {
    margin: 0;
}

.nav-item {
    list-style-type: none;
    font-weight: 100;
    display: inline;
    padding: 20px 40px;
    margin: 0;
    font-size: 1.1em;
    color: rgb(87, 87, 87);
    transition: all 0.25s ease-in-out;
}

.nav-item a:hover {
    color: black;
    transform: translateY(-2px);
    transition: all 0.3s ease-out;
}


a.nav-link {
    text-decoration: none;
    display: inline;
}

.content {
    padding-top: 70px;
}
</style>

<nav>
    <div class="navbar">
        <ul class="nav-list">
            <li class="nav-item active-list"><a class="nav-link" href="{{ route('dashboard') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('articles.all') }}">Articles</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('categories.all') }}">Categories</a></li>
        </ul>
    </div>
</nav>
