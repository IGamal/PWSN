@extends('layouts.main')

@section('title', 'Education')
@section('Background', 'educationBackground')

@section('content')

    @if($education->video) <video controls muted  poster="" > <source src="/videos/{{$education->video}}"> This video cannot be loaded </video> @endif {{-- check if that Education has a video --}}

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

    <h1>Other Videos</h1>
    <div class="row">
        @foreach($videos as $video)
            <div class="col-md-4">
                <h2>{{$video->title}}</h2>
                <video controls muted  width= "310"   height= "175"> <source src="/videos/{{$video->video}}"> This video cannot be loaded </video>
            </div>
        @endforeach
    </div>
@endsection
