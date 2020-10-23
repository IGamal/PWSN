@extends('layouts.main')

@section('title','Videos')
@section('Background', 'videosBackground')

@section('content')
    <h1>Videos</h1>
    @foreach($videos as $video)
            <img src="http://placehold.it/300" alt= "Test">

            <a href="/educations/{{$video->slug}}" lass="btn btn-primary">{{$video->title}}</a>
            <p class="card-text">{{$video->body}}</p>

            @endforeach
            </div>
@endsection
