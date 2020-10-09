@extends('layouts.main')

@section('title','Donations')
@section('Background', 'donationBackground')

@section('content')
    <h1>Donations</h1>
    <div class="row">
        @foreach($donations as $donation)
            <div class="col-md-6">
                <div class="card mb-5">
                    <h5 class="card-title">{{$donation->title}}</h5>
                    <div class="card-body">
                        <img src="images/{{$donation->image}}" class="card-img-top">
                        <p class="card-text">{{$donation->description}}</p>
                        <a href="/articles/{{$donation->slug}}" lass="btn btn-primary">see more....</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
