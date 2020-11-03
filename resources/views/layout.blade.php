<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Knowing Share</title>

    <!--CSS from internal sources-->
    <link rel="stylesheet" href="/css/main.css">
    @yield('css')

    <!--CSS from external sources-->
    <link rel="stylesheet" href="/css/boostrap.css">

    <!--Javscript from external sources-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!--Javascript from internal sources-->
    @yield('js')


</head>

<body>

    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Knowing Share</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('posts.index') }}">Posts</a></li>
                    <li><a href="/">About Us</a></li>
                    <li><a href="/">Contact</a></li>
                </ul>
                @if (session()->exists('auth'))
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" style="cursor:pointer">{{ session('name') }}<span class="caret"></span></a>

                            <ul class="dropdown-menu">
                                <li>
                                <a href="{{route('profile.show',session('username'))}}">Profile</a>
                                </li>
                                <li>
                                    <a href="{{route('posts.create')}}">New Post +</a>
                                </li>
                                @if(session('username') == 'dakota')
                                <li>
                                    <a href="{{route('logs')}}">Logs</a>
                                </li>
                                @endif
                                <li>
                                <a href="{{route('user.signout')}}">Sign Out</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @else
                    <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{route('user.sign')}}">Sign In</a></li>
                    </ul>
                @endif

            </div>
        </div>
    </nav>


    @yield('content')

</body>

</html>
