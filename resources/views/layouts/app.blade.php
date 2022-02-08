<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @yield('styles')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container m-3">
            <div class="row">
                @if (\Illuminate\Support\Facades\Auth::check())
                    <div class="col-lg-4">

                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="/home" >Home</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('categories') }}" >Categories</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('tag.index') }}" >Tags</a>
                            </li>

                            @if (\Illuminate\Support\Facades\Auth::user()->admin)
                                <li class="list-group-item">
                                    <a href="{{ route('users') }}" >Users</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('user.create') }}" >New User</a>
                                </li>
                            @endif

                            <li class="list-group-item">
                                <a href="{{ route('user.profile') }}" >My Profile</a>
                            </li>

                            <li class="list-group-item">
                                <a href="{{ route('tag.create') }}" >create a new Tag</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('posts') }}" >Posts</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('posts.trashed') }}" >All Trashed Posts</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('category.create') }}" >create new Category</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('post.create') }}" >create new Post</a>
                            </li>
                            @if (\Illuminate\Support\Facades\Auth::user()->admin)
                            <li class="list-group-item">
                                <a href="{{ route('settings') }}" >Settings</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                @endif

                <div class="col-lg-8">
                    @yield('content')
                </div>
            </div>

        </div>
    </div>
<script>
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{session()->get('success')}}
        </div>
    @endif
        @if(session()->has('error'))
        <div class="alert alert-danger">
        {{session()->get('error')}}
        </div>
    @endif
</script>
@yield('scripts')
</body>
</html>
