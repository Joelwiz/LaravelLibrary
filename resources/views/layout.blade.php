<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

</head>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- Right Side Of Navbar -->
<ul class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Authentication Links -->
    @guest
        @if (Route::has('login'))
            <li class="nav-item" style="list-style: none">
                <a class="btn nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="btn nav-item" style="list-style: none">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
    @endguest
    @auth
        @if (Route::has('logout'))
            <li class="nav-item" style="list-style: none;">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        @endif
    @endauth
</ul>
<body class="antialiased" style="background-color: lightskyblue">
@yield('content')
</body>
</html>
