@extends('layouts.main')

@section('title', 'Jobs')
@section('Background', 'jobBackground')

@section('content')
        <h1>Jobs</h1>
        <div class="row">
            @foreach($jobs as $job)
                <div class="col-md-6">
                    <div class="card mb-5">
                        <h5 class="card-title">{{$job->title}}</h5>
                        <div class="card-body">
                            <p class="card-text">{{$job->description}}</p>
                            <a href="/jobs/{{$job->slug}}" lass="btn btn-primary">see more....</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endsection
