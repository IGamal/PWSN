@extends('layouts.main')

@section('title', 'Donation')
@section('Background', 'donationBackground')

@section('content')
    <h1>{{$donation->title}}</h1>

    @if (auth()->id() === $donation->user_id) {{-- check for user who created that donation --}}
    <a href="/donations/{{$donation->slug}}/edit" ><i class="fa fa-pencil" style='font-size:33px;color:blue'></i></a>

    <a onclick="DeleteDonation({{$donation->id}})"><i class='fas fa-trash-alt' style='font-size:30px;color:red'></i></a>
    @endif

    @if($donation->image) <img src="/images/{{$donation->image}}"> @endif {{-- check if that article has an image --}}

    <div class="info">
        <h2> Info </h2>
        <p>{{$donation->description}}</p>
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
        <p>{{$donation->user->fullName()}}</p>
    </div>

    <div class="phone">
        <h2>  Phone Number </h2>
        <p>{{$donation->phone}}</p>
    </div>

    <div class="email">
        <h2>  Email </h2>
        <p> {{$donation->user->email}}</p>
    </div>

    <script>
        function DeleteDonation(id)
        {
            let _URl = `/donations/${id}`;
            let _token = "{{ csrf_token() }}";
            $.ajax({
                url: _URl,
                method: 'Delete',
                data:{
                    _token: _token
                },
                success: function (response) {
                    if(response.code == 200)
                    {
                        console.log(response)
                    }
                }
            })
        }
    </script>
@endsection

