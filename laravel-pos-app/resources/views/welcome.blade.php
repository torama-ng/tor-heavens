<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pos Manager</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
        
    </head>
    <body>        
        <nav class="site-header sticky-top py-1">
        <div class="container d-flex flex-column flex-md-row justify-content-between"> 
        <a class="navbar-brand mr-auto" href="{{ url('/') }}">
                                {{ config('app.name', 'Laravel') }}
            </a>
            @if (Route::has('login'))
                        <div class="top-right links">
                        
                            @auth
                                <a href="{{ url('/profile') }}">Profile</a>
                            @else
                                <a href="{{ route('login') }}">Login</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                
        </div>
        </nav>

        <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <h1 class="display-4 font-weight-normal">Pos Manager</h1>
            <p class="lead font-weight-normal">Manage your pos records with ease.</p>
            <a class="btn btn-outline-secondary" href="{{ route('register') }}">Register</a>
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
        </div>


        <footer class="container ">
        <div class="row justify-content-center">
            <div class="col-md-3  ml-5">
            <h5 class="ml-5">About</h5>
                <a class="text-muted " href="#">Team</a>
                <a class="text-muted " href="#">Locations</a>
                <a class="text-muted " href="#">Privacy</a>
                <a class="text-muted " href="#">Terms</a>
            <small class="d-block mb-3 text-muted">&copy; 2019</small>
            </div>
        </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script></body>

    </body>
</html>
