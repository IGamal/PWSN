@extends('layouts.main')

@section('title', 'Add Donation')
@section('Background', 'donationBackground')

@section('content')
    <h1>{{$donation->title}}</h1>

    @if (auth()->id() === $donation->user_id) {{-- check for user who created that article --}}
    <a class="btn btn-primary" href="/donations/{{$donation->slug}}/edit">Edit</a>
    @endif

    @if($donation->image) <img src="/images/{{$donation->image}}"> @endif {{-- check if that article has an image --}}

    <div class="info">
        <h2> Info </h2>
        <p>{{$donation->Description}}</p>
    </div>

    <div class="category">
        <h2> Category </h2>
        @foreach($donation->categories as $category)
            <span>{{$category->name}}</span>
        @endforeach

    </div>

    <div class="governorate">
        <h2> Governorate </h2>
        <p>{{$donation->governorate->name}}</p>
    </div>

    <div class="clear"></div>
    <div class="contact"> <p>Contact</p> </div>

    <div class="name">
        <h2>  Name </h2>
        <p>{{$donation->user->first_name . " " . $donation->user->first_name}}</p>
    </div>

    <div class="phone">
        <h2>  Phone Number </h2>
        <p>{{$donation->phone}}</p>
    </div>

    <div class="email">
        <h2>  Email </h2>
        <p> {{$donation->user->email}}</p>
    </div>
@endsection

