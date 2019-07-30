@extends('layouts.app')

@section('content')
<div class=" row justify-content-center"><h5 class="text-center col-md-6">POS RECORDS</h4></div>
  @if (session('success'))
          <div class="alert alert-success" role="alert">
              {{ session('success') }}
          </div>
      @endif  
    <div class=" row justify-content-center">       
        <a class="btn btn-primary mr-1"href="{{ route('customers') }}">Add Customer</a> 
        <a class="btn btn-primary mr-1"href="{{ route('posrecords.create') }}">Add Record</a> 
        <a href="{{ route('import') }}" class="btn btn-info mr-1">Import</a>
        <input class="form-control col-md-8" id="myInput" type="text" placeholder="Search.."> 
    </div>
    <table class="table table-striped responsive">
        <thead>
          <tr>
            <th scope="col">Customers Name</th>
            <th scope="col">Amount</th>
            <th scope="col">Card No#</th>
            <th scope="col">Trans ID</th>
            <th scope="col">Terminal Location</th>
            <th scope="col">Bank</th>
            <th scope="col">Transaction Date</th>
            <th scope="col">Action Taken</th>
            <th scope="col">Remarks</th>
            <th scope="col">Photo</th>
          </tr>
        </thead>
        <tbody id="myTable">
      @if(count($userrecords) > 0)
         @foreach($userrecords as $record)
            <tr>
            <td>{{$record->customers_name}}</td>
            <td>{{$record->amount}}</td>
            <td>{{$record->card_number}}</td>
            <td>{{$record->trans_id}}</td>
            <td>{{$record->terminal_location}}</td>
            <td>{{$record->bank}}</td>
            <td>{{$record->trans_date}}</td>
            <td>{{$record->action_taken}}</td>
            <td>{{$record->remarks}}</td>
            <td><button class="btn-primary showuser" data-avatar="{{ $record->avater}}" data-toggle="modal" data-target="#modalpix">
              image</button></td>
          
           
          </tr>
         <!-- Modal -->
      <div class="modal fade" id="modalpix" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            
      </div>
          @endforeach
         

          @else 
          <p>No Pos Records found</p>
          @endif
         
        </tbody>
        
      </table>
     <div  class=" row justify-content-center"> {{$posrecords->links()}} </div>
     
@endsection