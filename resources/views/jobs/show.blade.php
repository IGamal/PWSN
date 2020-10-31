@extends('layouts.main')

@section('title', 'Job')
@section('Background', 'jobBackground')

@section('content')
    <h1>{{$job->title}}</h1>
    @if (auth()->id() === $job->user_id) {{-- check for user who created that job --}}
        <a class="btn btn-primary" href="/jobs/{{$job->slug}}/edit">Edit</a>
    @endif

    <div class="description">
        <h2> Description </h2>
        <p>{{$job->description}}</p>
    </div>

    <div class="requirements">
        <h2> Requirements </h2>
        <p>{{$job->requirements}}</p>
    </div>

    <div class="clear"></div>
    <h2>Categories</h2>
        @foreach($job->categories as $category)
            <span>{{$category->name}}</span>
        @endforeach

    <div class="salary">
        <h2> Salary </h2>
        <p>{{$job->salary}}</p>
    </div>

    <div class="clear"></div>
    <div class="governorate">
        <h2> Governorate </h2>
        <p>{{$job->governorate->name}}</p>
    </div>

    <div class="clear"></div>
    <div class="contact"> <p>Contact</p> </div>

    <div class="name">
        <h2>  Name </h2>
        <p>{{$job->user->fullName()}}</p>
    </div>

    <div class="phone">
        <h2>  Phone Number </h2>
        <p>{{$job->phone}}</p>
    </div>

    <div class="email">
        <h2>  Email </h2>
        <p> {{$job->user->email}}</p>
    </div>

@endsection
