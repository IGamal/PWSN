@extends('layouts.main')

@section('title', 'Add Donation')
@section('Background', 'donationBackground')

@section('content')
    <h1>Edit Donation</h1>

    {{-- Edit Donation form  --}}
    {!! Form::model($donation, ['method' => 'PATCH', "action" => ['App\Http\Controllers\DonationController@update', $donation->slug], 'files' => 'true']) !!}

    {{-- Title Field --}}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('title')) <div class="alert alert-danger">{{$errors->first('title') }}</div> @endif
        {{Form::text('title', $donation->title, ['class' => 'form-input', 'placeholder' => 'Type your the Title here...'])}}
    </div>

    {{-- Image Field --}}
    <div class="form-group">
        {{Form::label('image', 'Image')}}
        @if($donation->image) <img src="/images/{{$donation->image}}"> @endif {{-- check if that article has an image --}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('image')) <div class="alert alert-danger">{{$errors->first('image') }}</div> @endif
        <input type="file" class="photo" name="image" > <p class="p3"> Change the Image....</p>
    </div>

    {{-- Description Field --}}
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('description')) <div class="alert alert-danger">{{$errors->first('description') }}</div> @endif
        {{Form::textarea('description', $donation->description, ['class' => 'form-input', 'placeholder' => '&nbsp;Add Text.....'])}}
    </div>

    {{-- Governorate Field --}}
    <div class="form-group">
        {{Form::label('governorate', 'Governorate')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('governorate_id')) <div class="alert alert-danger">{{$errors->first('governorate_id') }}</div> @endif
        {{Form::select('governorate_id', $governorates, null, ['class' =>'form-input', 'placeholder' => 'Change the Governorate...'])}}
    </div>

    {{-- Phone Number Field --}}
    <div class="form-group">
        {{Form::label('phone', 'Phone Number')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('phone')) <div class="alert alert-danger">{{$errors->first('phone') }}</div> @endif
        {{Form::text('phone', $donation->phone, ['class' => 'form-input', 'placeholder' => 'Type your Phone Number here...'])}}
    </div>

    {{-- Category Field --}}
    <div class = "form-group">
        {!! Form::label('category_id', 'Category', ['class' => 'control-label']) !!}
        <h2>Your Categories</h2>
        @foreach($donation->categories as $category)
            <span>{{$category->name}}</span>
        @endforeach
        {{-- Check if the field has any errors --}}
        @if($errors->has('category_id')) <p class="alert alert-danger">{{$errors->first('category_id') }}</p> @endif
        <select name="category_id[]" class ='form-textarea' placeholder ="Change your Category" multiple>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </div>

    <div>
        {{Form::submit('Edit Donation', ['class' => 'btn btn-primary'])}}
    </div>
    {!! Form::close() !!}

    {{-- Delete Article form  --}}
    {!! Form::model($donation, ['method' => 'DELETE', "action" => ['App\Http\Controllers\DonationController@destroy',
                    $donation->slug], 'onsubmit' => 'return confirm("Are You sure You Want To Delete This Donation")']) !!}
    <div>
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    </div>
    {!! Form::close() !!}

@endsection
