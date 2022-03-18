<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>{{ config('app.name', 'Laravel') }}</title>

     <!-- Latest compiled and minified CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"->

<!-- Latest compiled and minified JavaScript -->
<!--script src="https://code.jquery.com/jquery-1.12.4.min.js" crossorigin="anonymous"></script-->

<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>

<!--script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.0.0/parsley.min.js" crossorigin="anonymous"></script-->


<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Scripts -->
<script src="{{ URL::asset('js/app.js') }}" defer></script>
<!--script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet"> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

</head>
<body>
    <div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ URL::asset('/img/halo-finance.png') }}">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
        </li>
        
        @auth
        <li class="nav-item">
          <a class="nav-link" href="{{ route('applications.index') }}">Applications</a>
        </li>
        @endauth
       

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Benefits
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ asset('/patient') }}">To The Patient</a></li>
            <li><a class="dropdown-item" href="{{ asset('/practice') }}">To The Practice</a></li>

          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Resources
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">eBrochures</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Privacy Policy</a></li>
            <li><a class="dropdown-item" href="#">Terms and Conditions</a></li>
          </ul>
        </li>
        
        @auth
        <li class="nav-item">
          <a class="nav-link" href="{{ asset('/user-profile') }}">Profile</a>        
        </li>
        @endauth
        <li class="nav-item">
          <a class="nav-link" href="{{ route('contact.index') }}">Contact</a>
        </li>

        @auth 
        @if(auth()->user()->isAdmin())
        <li class="nav-item dropdown">
          <a class="btn btn-info dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Admin
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('users.index') }}">All Users</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('archived-applications.index') }}">Archived Applications</a></li>
          </ul>
        </li>
        @endif
        @endauth


        @if (Route::has('login'))
        @auth
        <li class="nav-item">
          <a class="nav-link btn btn-secondary text-white ms-3" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Logout</a>
        </li>
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        

      </ul>
   @else
      <a href="{{ route('login') }}" class="btn btn-info mx-2">Login</a>
        <a href="{{ route('register') }}" class="btn btn-info mx-2">{{ __('Register') }}</a>
        

   @endauth 
    @endif

    </div>
  </div>
    
</nav>

        <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <!--div class="col-md-12">
                    <div class="card"-->

                            <!-- Success message -->
                                @if(Session::has('success'))
                                    <div class="alert alert-success">
                                        {{Session::get('success')}}
                                    </div>
                                @endif
           
                     @yield('content')
                     
                     <!--/div>

                     
                </div-->
            </div>
        </div>
        </main>
    </div>
</body>
</html>


