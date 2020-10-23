@extends('layouts.main')

@section('title', 'Education')
@section('Background', 'educationBackground')

@section('content')
    <h1>{{$education->title}}</h1>
    @if (auth()->id() === $education->user_id) {{-- check for user who created that education --}}
    <a class="btn btn-primary" href="/educations/{{$education->slug}}/edit">Edit</a>
    @endif

    <div class="article">
        <h2> Article </h2>
        <p>{{$education->body}}</p>
    </div>

    <div>
        <h2>Categories</h2>
        @foreach($education->categories as $category)
            <span>{{$category->name}}</span>
        @endforeach
    </div>
@endsection
