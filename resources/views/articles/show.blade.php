@extends('layouts.main')

@section('title', 'Article')
@section('Background', 'articleBackground')

@section('content')
    <h1>{{$article->title}}</h1>
    @if (auth()->id() === $article->user_id) {{-- check for user who created that article --}}
    <a class="btn btn-primary" href="/articles/{{$article->slug}}/edit">Edit</a>
    @endif

    @if($article->image) <img src="/images/{{$article->image}}"> @endif {{-- check if that article has an image --}}

    <div class="article">
        <h2> Article </h2>
        <p>{{$article->body}}</p>
    </div>

    @if($article->video) <video controls muted  poster="" > <source src="/videos/{{$article->video}}"> This video cannot be loaded </video> @endif {{-- check if that article has a video --}}

    <div>
        <h2>Categories</h2>
        @foreach($article->categories as $category)
            <span>{{$category->name}}</span>
        @endforeach
    </div>
@endsection
