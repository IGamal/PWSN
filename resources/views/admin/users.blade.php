@extends('layouts.adminPanel')

@section('content')
    @if($errors->has('erroro')) <div class="alert alert-danger">{{$errors->first('erroro') }}</div> @endif

    {!! Form::open(['action' => 'App\Http\Controllers\AdminController@getUser', 'method' => 'POST']) !!}

        {{-- User ID Field --}}
        <div class="form-group">
            {!!Form::label('User ID', 'User ID')!!}
            {{-- Check if the field has any errors --}}
            @if($errors->has('id')) <div class="alert alert-danger">{{$errors->first('id') }}</div> @endif
            {!!Form::text('id', '', ['class' => 'form-control', 'placeholder' => 'insert User ID here...'])!!}
        </div>

        <div>
            {{Form::submit('Get', ['class' => 'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}

    @if(isset($user))
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
                <th>Make Admin</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody>
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
                    <th>
                        {!! Form::model($user, ['method' => 'POST', 'action' =>['App\Http\Controllers\AdminController@makeadmin', $user->id], 'onsubmit' => 'return confirm("Are You sure You Want To Make this User an ADMIN")']) !!}
                        {!! Form::submit('Make Admin',['class' => 'btn btn-success']) !!}
                        {!! Form::close() !!}
                    </th>
                    <th>
                        {!! Form::model($user, ['method' => 'DELETE', "action" => ['App\Http\Controllers\UserController@destroy', $user->id], 'onsubmit' => 'return confirm("Are You sure You Want To Delete This User")']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </th>
                </tr>
            </tbody>
        </table>
    @endif

@endsection
