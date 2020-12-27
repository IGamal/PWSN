<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield("title",'AdminPanel')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        table, th, td
        {
            margin: 25px;
            padding: 7px;
            border-collapse: collapse;
            text-align: center;
        }
        th
        {
            border: 1px black;
            background-color: lightgrey;
        }
    </style>
<body>
    @include('includes.navbar')

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
                    <li> <a href="/admin"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a> </li> <hr>
                    <!-- Dashboard -->

                    <!-- Admins -->
                    <li> <a href="{{route('adminPanel_admins')}}"><i class="fa fa-wrench fa-fw"></i>admins</a> </li> <hr>
                    <!-- Admins -->

                    <!-- Users -->
                    <li> <a href="{{route('adminPanel_users')}}"><i class="fa fa-wrench fa-fw"></i>Users</a> </li> <hr>
                    <!-- Users -->

                    <!-- Donations -->
                    <li> <a href="{{route('adminPanel_donations')}}"><i class="fa fa-wrench fa-fw"></i> Donations</a> </li> <hr>
                    <!-- Donations -->

                    <!-- Jobs -->
                    <li> <a href="{{route('adminPanel_jobs')}}"><i class="fa fa-wrench fa-fw"></i> Jobs</a> </li> <hr>
                    <!-- Jobs -->

                    <!-- Categories -->
                    <li> <a href="{{route('categories.index')}}"><i class="fa fa-wrench fa-fw"></i> Categories</a> </li> <hr>
                    <!-- Categories -->

                </ul>
            </div>

            <div class="col-md-11">
                @yield('content')
            </div>
        </div>
    </div>

    @include('includes.footer')

    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>
