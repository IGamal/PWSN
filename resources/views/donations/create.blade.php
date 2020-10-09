@extends('layouts.main')

@section('title', 'Add Donation')
@section('Background', 'donationBackground')

@section('content')
    <h1>Add Donation</h1>

    {{-- Create New Article form  --}}
    {!! Form::open(['action' => 'App\Http\Controllers\DonationController@store', 'method' => 'POST', 'files' => 'true']) !!}

    {{-- Title Field --}}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('title')) <div class="alert alert-danger">{{$errors->first('title') }}</div> @endif
        {{Form::text('title', '', ['class' => 'form-input', 'placeholder' => 'Type your the Title here...'])}}
    </div>

    {{-- Image Field --}}
    <div class="form-group">
        {{Form::label('image', 'Image')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('image')) <div class="alert alert-danger">{{$errors->first('image') }}</div> @endif
        <input type="file" class="photo" name="image" > <p class="p3"> Add Photo....</p>
    </div>


    {{-- Description Field --}}
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('description')) <div class="alert alert-danger">{{$errors->first('description') }}</div> @endif
        {{Form::textarea('description', '', ['class' => 'form-textarea', 'placeholder' => '&nbsp;Add Text.....'])}}
    </div>

    {{-- Governorate Field --}}
    <div class="form-group">
        {{Form::label('governorate', 'Governorate')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('governorate_id')) <div class="alert alert-danger">{{$errors->first('governorate_id') }}</div> @endif
        {{Form::select('governorate_id', $governorates, null, ['class' =>'form-input', 'placeholder' => 'choose a Governorate...'])}}
    </div>

    {{-- Phone Number Field --}}
    <div class="form-group">
        {{Form::label('phone', 'Phone Number')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('phone')) <div class="alert alert-danger">{{$errors->first('phone') }}</div> @endif
        {{Form::text('phone', '', ['class' => 'form-input', 'placeholder' => 'Type your Phone Number here...'])}}
    </div>

    {{-- Category Field --}}
    <div class = "form-group">
        {!! Form::label('category_id', 'Category', ['class' => 'control-label']) !!}
        {{-- Check if the field has any errors --}}
        @if($errors->has('category_id')) <p class="alert alert-danger">{{$errors->first('category_id') }}</p> @endif
        <select name="category_id[]" class ='form-textarea' placeholder ="Choose one or more Category" multiple>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
    </div>

    <div>
        {{Form::submit('Add Donation', ['class' => 'btn btn-primary'])}}
    </div>
    {!! Form::close() !!}

@endsection
