@extends('layouts.main')

@section('title', 'Log_In')
@section('Background', 'userBackground')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h1> Login </h1>

                <div class="card-body">
                    {!! Form::open(['action' => 'App\Http\Controllers\Auth\LoginController@login', 'method' => 'POST']) !!}

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



                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                        <div>
                            {{Form::submit('logIn', ['class' => 'button'])}}
                        </div>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
