<nav class="navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="/home">PWSN</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <a class="nav-link" href="{{ url('/home') }}">Home</a>
                        @endauth
                    </div>
                @endif
        </ul>
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="/users/create">Register</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link" href="/account"> {{ Auth::user()->name }} </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            @endguest
        </ul>

    </div>
</nav>
