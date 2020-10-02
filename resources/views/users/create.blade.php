@extends('layouts.main')

@section('title', 'registration')
@section('Background', 'userBackground')

@section('content')
    <h1 class="title"> Registation </h1>

    {!! Form::open(['action' => 'App\Http\Controllers\UserController@store', 'method' => 'POST', 'files' => 'true']) !!}

    {{-- First Name Field --}}
    <div class="form-group">
        {{Form::label('first_name', 'First Name')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('first_name')) <div class="alert alert-danger">{{$errors->first('first_name') }}</div> @endif
        {{Form::text('first_name', '', ['class' => 'form-input', 'placeholder' => 'Type your First name here...'])}}
    </div>

    {{-- Last Name Field --}}
    <div class="form-group">
        {{Form::label('last_name', 'Last Name')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('last_name')) <div class="alert alert-danger">{{$errors->first('last_name') }}</div> @endif
        {{Form::text('last_name', '', ['class' => 'form-input', 'placeholder' => 'Type your last name here...'])}}
    </div>

    {{-- Email Field --}}
    <div class="form-group">
        {{Form::label('email', 'Email')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('email')) <div class="alert alert-danger">{{$errors->first('email') }}</div> @endif
        {{Form::email('email', '', ['class' => 'form-input', 'placeholder' => 'Type your Email here...'])}}
    </div>

    {{-- Password Field --}}
    <div class="form-group">
        {{Form::label('password', 'Password')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('password')) <div class="alert alert-danger">{{$errors->first('password') }}</div> @endif
        {{Form::password('password', ['class' => 'form-input'])}}
    </div>

    {{-- confirm Password Field --}}
    <div class="form-group">
        {{Form::label('confirm_password', 'Confirm Password')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('password_confirmation')) <div class="alert alert-danger">{{$errors->first('password_confirmation') }}</div> @endif
        {{Form::password('password_confirmation', ['class' => 'form-input'])}}
    </div>

    {{-- Phone Number Field --}}
    <div class="form-group">
        {{Form::label('Phone_Number', 'Phone Number')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('phone')) <div class="alert alert-danger">{{$errors->first('phone') }}</div> @endif
        {{Form::text('phone', '', ['class' => 'form-input', 'placeholder' => 'Type your Phone Number here...'])}}
    </div>

    {{-- Birthday Field --}}
    <div class="form-group">
        {{Form::label('Birthday', 'Birthday')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('birthday')) <div class="alert alert-danger">{{$errors->first('birthday') }}</div> @endif
        {{Form::date('birthday', '', ['class' => 'form-input'])}}
    </div>

    {{-- Profile Picture Field --}}
    <div class="form-group">
        {{Form::label('Profile_Picture', 'Profile Picture')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('image')) <div class="alert alert-danger">{{$errors->first('image') }}</div> @endif
        <div class="form-image">{{Form::file('image')}}</div>
    </div>

    <div class="btn-div">
        {{Form::submit('Register', ['class' => 'button'])}}
    </div>
    {!! Form::close() !!}
@endsection
