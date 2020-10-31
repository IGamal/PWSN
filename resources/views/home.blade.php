@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">Articles</div>

                <div class="card-body">
                    @foreach($articles as $article)
                        <div class="row">
                            <div class="col-md-6">
                                <img src="images/{{$article->image}}" class="card-img-top">
                            </div>
                            <div class="col-md-7">
                                <h5 class="card-title">{{$article->title}}</h5>
                                <p class="card-text">{{$article->body}}</p>
                                <a href="/articles/{{$article->slug}}" lass="btn btn-primary">see more....</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card">
                <div class="card-header">News</div>

                <div class="card-body">
                    @foreach($newses as $news)
                        <div class="row">
                            <div class="col-md-6">
                                <img src="images/{{$news->image}}" class="card-img-top">
                            </div>
                            <div class="card mb-4">
                                <h5 class="card-title">{{$news->title}}</h5>
                                <p class="card-text">{{$news->body}}</p>
                                <a href="/news/{{$news->slug}}" lass="btn btn-primary">see more....</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Donations</div>

                <div class="card-body">
                    @foreach($donations as $donation)
                        <div>
                            <img src="images/{{$donation->image}}" class="card-img-top">
                                <br>
                            <a href="/donations/{{$donation->slug}}" lass="btn btn-primary">{{$donation->title}}</a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card">
                <div class="card-header">Jobs</div>

                <div class="card-body">
                    @foreach($jobs as $job)
                        <div>
                            <img src="images/{{$job->image}}" class="card-img-top">
                            <br>
                            <a href="/jobs/{{$job->slug}}" lass="btn btn-primary">{{$job->title}}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
