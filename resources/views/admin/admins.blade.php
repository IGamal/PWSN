@extends('layouts.adminPanel')

@section('content')
    <p>Admins</p>

    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Email Verified at</th>
            <th>Image</th>
            <th>Phone Number</th>
            <th>Birthday</th>
            <th>Verified</th>
            <th>Admin</th>
            <th>Created at</th>
            <th>updated at</th>
        </tr>
        </thead>

        <tbody>
        @foreach($admins as $user)
            <tr>
                <th>{{$user->id}}</th>
                <th>{{$user->fullName()}}</th>
                <th>{{$user->email}}</th>
                <th>{{$user->email_verified_at}}</th>
                <th><img height= '50' src="{{$user->image}}"></th>
                <th>{{$user->phone}}</th>
                <th>{{$user->birthday}}</th>
                <th>{{$user->verified}}</th>
                <th>{{$user->admin}}</th>
                <th>{{$user->created_at->diffforhumans()}}</th>
                <th>{{$user->updated_at->diffforhumans()}}</th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
