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
<div class=" row justify-content-center"><h5 class="text-center col-md-6">POS RECORDS FORM</h4></div>

    <form action="{{ route('posrecords') }}" class="py-1" method="POST" enctype="multipart/form-data" >
    <div class="form-row justify-content-center">
        <div class="form-group col-md-6 ">
        <label> Customers Name</label>
        <select id="selct2" class=" form-control form-control" name="customers_name"  >
            @foreach($customers as $customer)
            <option selected value="{{$customer->name}}">{{$customer->name}}</option>
           @endforeach
        </select>
        <div>{{$errors->first('customers_name')}}</div>
        </div>
    </div>  
    
  <div class="form-row justify-content-center">
  <div class="form-group col-md-3 ">
        <label >Amount</label>
  <input name="amount" type="text" value="{{old('amount')}}"class="form-control form-control"  placeholder="Enter Amount">
        <div>{{$errors->first('amount')}}</div>
    </div>

     <div class="form-group col-md-3" >
        <label >Bank</label>
        <select name="bank" class="form-control form-control">
                <option selected>Choose...</option>
                <option> GTbank</option>
                <option> Access Bank</option>
                <option> First Bank</option>
                <option> Eco Bank</option>
                <option> Zenith bank</option>
                <option> Fidelity bank</option>
                <option> Wema bank</option>
            </select>
        <div>{{$errors->first('bank')}}</div>
     </div>
  </div> 
  <div class="form-row justify-content-center">
    <div class="form-group col-md-3" >
        <label >Atm Card Number</label>
        <input name="card_number" type="text" value="{{old('card_number')}}"class="form-control form-control"  placeholder="Enter Card Number">
        <div>{{$errors->first('card_number')}}</div>
    </div>

    <div class="form-group col-md-3" >
            <label >Transacton ID</label>
            <input name="trans_id" type="text" value="{{old('trans_id')}}"class="form-control form-control"  placeholder="Enter Transaction ID">
            <div>{{$errors->first('trans_id')}}</div>
        </div> 
  </div> 
 
    <div class="form-row justify-content-center">   
     <div class="form-group col-md-3">
        <label >Terminal Location</label>
        <select name="terminal_location" class="form-control form-control">
            <option selected>Choose...</option>
            <option> Fido Okutukutu</option>
            <option> Fido Swali</option>
            <option> Fido Kpansia</option>
            <option> Fido Obunna</option>
            <option> Fido Yenegwe</option>
        </select>
        </div>
        
        <div class="form-group col-md-3" >
            <label >Transaction Date_time</label>
            <input name="trans_date_time" type="datetime-local" value="{{old('trans_date_time')}}" class="form-control form-control"  placeholder="mm/dd/yyyy">
            <div>{{$errors->first('trans_date_time')}}</div>
        </div>
    </div>
    <div class="form-row justify-content-center">
        <div class="form-group col-md-6">
        <label> Action Taken</label>
        <select name="action_taken" class="form-control form-control">    
            <option selected>Choose..</option>
            <option> Product Released</option>
            <option> Product not Released</option>
        </select>
    </div>
    </div>
    <div class="form-row justify-content-center">
        <div class="form-group col-6" >
        <input class="form-control form-control" type="file" name="avater">
        <div>{{$errors->first('avater')}}</div>
    </div>
    </div>
    <div class="form-row justify-content-center"> 
    <div class="form-group col-6" >
        <label> Remark</label>
        <textarea name="remarks" value="{{old('remarks')}}"class="form-control" rows="3" placeholder="Remark..."></textarea>
        <div>{{$errors->first('remarks')}}</div>
    </div>
    </div>

  <div class="form-row justify-content-center"> 
  <button type="submit" class="btn btn-primary col-md-3">Add Record</button>
  </div>
  @csrf
</form>

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
            $('#selct2').select2({
                 tags: true
                });
        });
     
   
    </script>
    
</body>
</html>





