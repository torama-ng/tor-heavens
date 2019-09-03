<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Torama Pos-Manager') }}</title>
  <script
    src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    @yield('js')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/3a9d6784a1.js"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
      @include('inc.navbar')
     <div class="col-md-3">
      <div class="sidebar">
      @include('inc.sidenav')
      </div>
      </div>
      
      <div class="col">
      <div id="main">
        <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
        </main>
        </div>
    </div>
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
    
    <script>
      $(document).ready(function(){
          //Upload
          $('.showuser').on('click', function() {
              $('#modalpix').html('<div class="modal-body modal-dialog modal-content " role="document"><div class="col-md-4"><img src="uploads/avater/' + $(this).data('avatar') + '"/> </div><div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></div>  </div>')
          });
          
      });
     
      $(document).ready(function(){
        $("#myInput").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });
   
    </script>
    
</body>
</html>
