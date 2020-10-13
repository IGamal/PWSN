@extends('layouts.main')

@section('title', 'Add Job')
@section('Background', 'jobBackground')

@section('content')
    <h1>Add Job</h1>

    {{-- Create New Job form  --}}
    {!! Form::open(['action' => 'App\Http\Controllers\JobController@store', 'method' => 'POST']) !!}

    {{-- Title Field --}}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('title')) <div class="alert alert-danger">{{$errors->first('title') }}</div> @endif
        {{Form::text('title', '', ['class' => 'form-input', 'placeholder' => 'Type your the Title here...'])}}
    </div>

    {{-- Description Field --}}
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('description')) <div class="alert alert-danger">{{$errors->first('description') }}</div> @endif
        {{Form::textarea('description', '', ['class' => 'form-textarea', 'placeholder' => '&nbsp;Add Text.....'])}}
    </div>

    {{-- Requirements Field --}}
    <div class="form-group">
        {{Form::label('requirements', 'Requirements')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('requirements')) <div class="alert alert-danger">{{$errors->first('requirements') }}</div> @endif
        {{Form::textarea('requirements', '', ['class' => 'form-textarea', 'placeholder' => '&nbsp;Add Requirements here.....'])}}
    </div>

    {{-- Salary Field --}}
    <div class="form-group">
        {{Form::label('salary', 'Salary')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('salary')) <div class="alert alert-danger">{{$errors->first('salary') }}</div> @endif
        {{Form::text('salary', '', ['class' => 'form-input', 'placeholder' => 'Add salary here...'])}}
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
            {{Form::submit('Add Job', ['class' => 'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}

@endsection
