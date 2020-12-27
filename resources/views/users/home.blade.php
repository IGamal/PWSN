@extends('layouts.main')

@section('title', 'Article')
@section('Background', 'articleBackground')

@section('content')
    <div class="@yield('Background')">
        @if(Session('success')) <p class="flex-center btn btn-success"> {{session('success')}}</p> @endif
        @if(Session('error')) <p class="flex-center btn btn-danger"> {{session('error')}}</p> @endif

        <div class="row">
            <div class="col-md-1">
                <ul>
                    <hr>
                    <!-- Search -->
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">

                            <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                    </li>
                    <hr>
                    <!-- Search -->

                    <!-- Dashboard -->
                    <li> <a href="/admin"><i class="fa fa-dashboard fa-fw"></i> {{$user->fullName()}}</a> </li> <hr>
                    <!-- Dashboard -->

                    <!-- Admins -->
                    <li> <a href="{{route('adminPanel_admins')}}"><i class="fa fa-wrench fa-fw"></i>admins</a> </li> <hr>
                    <!-- Admins -->

                    <!-- Users -->
                    <li> <a href="/users/{{$user->id}}/edit"><i class="fa fa-wrench fa-fw"></i>Edit Your Data</a> </li> <hr>
                    <!-- Users -->

                    <!-- Donations -->
                    <li> <a href="{{route('user_favourite')}}"><i class="fa fa-wrench fa-fw"></i> Favourites</a> </li> <hr>
                    <!-- Donations -->

                    <!-- Jobs -->
                    <li> <a href="{{route('user_save')}}"><i class="fa fa-wrench fa-fw"></i> Saved for later</a> </li> <hr>
                    <!-- Jobs -->

                    <!-- Categories -->
                    <li> <a href="{{route('categories.index')}}"><i class="fa fa-wrench fa-fw"></i> Categories</a> </li> <hr>
                    <!-- Categories -->

                </ul>
            </div>

            <div class="col-md-11">
                @yield('contents')
            </div>
        </div>
    </div>
@endsection
