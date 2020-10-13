@extends('layouts.main')

@section('title','News')
@section('Background', 'newsBackground')

@section('content')
    <h1>{{$news->title}}</h1>
    @if (auth()->id() === $news->user_id) {{-- check for user who created that news --}}
    <a class="btn btn-primary" href="/news/{{$news->slug}}/edit">Edit</a>
    @endif

    @if($news->image) <img src="/images/{{$news->image}}"> @endif {{-- check if that news has an image --}}

    <div class="article">
        <h2> News </h2>
        <p>{{$news->body}}</p>
    </div>

    @if($news->video) <video controls muted  poster="" > <source src="/videos/{{$news->video}}"> This video cannot be loaded </video> @endif {{-- check if that news has a video --}}

    <div>
        <h2>Categories</h2>
        @foreach($news->categories as $category)
            <span>{{$category->name}}</span>
        @endforeach
    </div>
@endsection
