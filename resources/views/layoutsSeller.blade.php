<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>eCommerce</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/custom.css">
    <script src="main.js"></script>
    <script src="/js/custom.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Nelly eCommerce</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
            <div class="dropdown">
                <button class="dropbtn">Products</button>
                <div class="dropdown-content">
                    <a class="nav-link"  href="/products/{{ Auth::user()->id  }}">All Products</a>
                    <a class="nav-link"  href="/features/{{ Auth::user()->id  }}">Features</a>
                </div>
            </div>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="/ordersseller">Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/reviews">Reviews</a>
        </li>
        <li class="nav-item dropdown">
            <div class="dropdown">
                <button class="dropbtn"> {{ Auth::user()->name }}</button>
                <div class="dropdown-content">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </div>
            </div>
        </li>
                       
        </ul>
        <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
    </nav>
    <div class="container">
        @if(count($errors))
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors as $error)
                    <li>{{ $error }}</li>

                    @endforeach
                </ul>
            </div>

        @endif

        @if($message=session("success_message"))
            <div id ="formSuccess" class="alert alert-success"></div>

        @endif

        @yield('content')
    </div>
    
</body>
</html>