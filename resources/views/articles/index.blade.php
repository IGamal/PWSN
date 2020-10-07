@extends('layouts.main')

@section('title','Articles')
@section('Background', 'articleBackground')

@section('content')
        <h1>Articles</h1>
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-6">
                    <div class="card mb-5">
                        <h5 class="card-title">{{$article->title}}</h5>
                        <div class="card-body">
                            <img src="images/{{$article->image}}" class="card-img-top">
                            <p class="card-text">{{$article->body}}</p>
                            <a href="/articles/{{$article->slug}}" lass="btn btn-primary">see more....</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endsection
