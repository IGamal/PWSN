@extends('layouts.adminPanel')

@section('content')
    <h1>Donations</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Author ID</th>
                <th>Email</th>
                <th>Title</th>
                <th>Image</th>
                <th>Description</th>
                <th>Phone Number</th>
                <th>Governorate</th>
                <th>categories</th>
                <th>Created at</th>
                <th>updated at</th>
                <th>Approve</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            @foreach($donations as $donation)
                <tr>
                    <th>{{$donation->id}}</th>
                    <th>{{$donation->user->fullName()}}</th>
                    <th>{{$donation->user->id}}</th>
                    <th>{{$donation->user->email}}</th>
                    <th>{{$donation->title}}</th>
                    <th><img height= '50' src="{{$donation->image}}"></th>
                    <th>{{$donation->description}}</th>
                    <th>{{$donation->phone}}</th>
                    <th>{{$donation->governorate->name}}</th>
                    <th>
                        @foreach($donation->categories as $category)
                            <span>{{$category->name}} / </span>
                        @endforeach
                    </th>
                    <th>{{$donation->created_at->diffforhumans()}}</th>
                    <th>{{$donation->updated_at->diffforhumans()}}</th>
                    <th>
                        {!! Form::model($donation, ['action' =>['App\Http\Controllers\DonationController@approve', $donation->slug], 'method' => 'POST']) !!}
                            {!! Form::submit('Approve',['class' => 'btn btn-success']) !!}
                        {!! Form::close() !!}
                    </th>
                    <th>
                        {!! Form::model($donation, ['method' => 'DELETE', "action" => ['App\Http\Controllers\DonationController@destroy', $donation->slug]]) !!}
                            {!!Form::submit('Delete', ['class' => 'btn btn-danger'])!!}
                        {!! Form::close() !!}
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
