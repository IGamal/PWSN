@extends('layouts.main')

@section('title','Books')
@section('Background', 'bookBackground')

@section('content')
        <h1>Books</h1>
            @foreach($books as $book)
                    <img src="http://placehold.it/300" alt= "Test">

                    <a href="/educations/{{$book->slug}}" lass="btn btn-primary">{{$book->title}}</a>
                    <p class="card-text">{{$book->body}}</p>
            @endforeach
        </div>
@endsection
