@extends('layouts.main')

@section('title', 'registration')
@section('Background', 'userBackground')

@section('content')
    <h1 class="title"> Registation </h1>

    {!! Form::model($user, ['method' => 'PATCH', "action" => ['App\Http\Controllers\UserController@update', $user->id], 'files' => 'true']) !!}

    {{-- Profile Picture Field --}}
    <div class="form-group">
        {{Form::label('Profile_Picture', 'Profile Picture')}}
        @if($user->image) <img src="/images/{{$user->image}}"> @endif
        {{-- Check if the field has any errors --}}
        @if($errors->has('image')) <div class="alert alert-danger">{{$errors->first('image') }}</div> @endif
        <div class="form-image">{{Form::file('image')}}</div>
    </div>

    {{-- First Name Field --}}
    <div class="form-group">
        {{Form::label('first_name', 'First Name')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('first_name')) <div class="alert alert-danger">{{$errors->first('first_name') }}</div> @endif
        {{Form::text('first_name', $user->first_name, ['class' => 'form-input', 'placeholder' => 'Type your First name here...'])}}
    </div>

    {{-- Last Name Field --}}
    <div class="form-group">
        {{Form::label('last_name', 'Last Name')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('last_name')) <div class="alert alert-danger">{{$errors->first('last_name') }}</div> @endif
        {{Form::text('last_name', $user->last_name, ['class' => 'form-input', 'placeholder' => 'Type your last name here...'])}}
    </div>

    {{-- Phone Number Field --}}
    <div class="form-group">
        {{Form::label('Phone_Number', 'Phone Number')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('phone')) <div class="alert alert-danger">{{$errors->first('phone') }}</div> @endif
        {{Form::text('phone', $user->phone, ['class' => 'form-input', 'placeholder' => 'Type your Phone Number here...'])}}
    </div>

    {{-- Birthday Field --}}
    <div class="form-group">
        {{Form::label('Birthday', 'Birthday')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('birthday')) <div class="alert alert-danger">{{$errors->first('birthday') }}</div> @endif
        {{Form::date('birthday', $user->birthday, ['class' => 'form-input'])}}
    </div>

    <div class="btn-div">
        {{Form::submit('Update', ['class' => 'button'])}}
    </div>
    {!! Form::close() !!}

    {!! Form::model($user, ['method' => 'DELETE', "action" => ['App\Http\Controllers\UserController@destroy', $user->id]]) !!}
        <div>
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        </div>
    {!! Form::close() !!}
@endsection
