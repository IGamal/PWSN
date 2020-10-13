@extends('layouts.main')

@section('title','News')
@section('Background', 'newsBackground')

@section('content')
        <h1>News</h1>
        <div class="row">
            @foreach($newses as $news)
                <div class="col-md-6">
                    <div class="card mb-5">
                        <h5 class="card-title">{{$news->title}}</h5>
                        <div class="card-body">
                            <img src="images/{{$news->image}}" class="card-img-top">
                            <p class="card-text">{{$news->body}}</p>
                            <a href="/news/{{$news->slug}}" lass="btn btn-primary">see more....</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endsection
