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
        <input class="form-control col-md-4" id="myInput" type="text" placeholder="Search.."> 
        
        
      <button class="btn btn-default" >Filter By:</button>
        
      <button class="btn btn-default" >
        <a class=" dropdown-toggle" href="#" id="link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Bank <span class="badge badge-secondary ml-1">{{$bank_count}}</span>
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="/posrecords?bank=Gtbank">Gtbank </a>
            <a class="dropdown-item" href="/posrecords?bank=Access bank">Access Bank</a>
            <a class="dropdown-item" href="/posrecords?bank=Uba bank">Uba bank </a>
            <a class="dropdown-item" href="/posrecords?bank=Wema bank">Wema Bank </a>
            <a class="dropdown-item" href="/posrecords?bank=First bank">First bank</a>
            <a class="dropdown-item" href="/posrecords?bank=Zenith bank">Access Bank</a>
          </div>
          </button>

      <button class="btn btn-default" >
        <a class="dropdown-toggle" href="#" id="link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Location  <span class="badge badge-secondary ml-1">{{$loc_count}}</span>
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item link" href="/posrecords?terminal_location=Fido Okutukutu">Fido Okutukutu  </a>
            <a class="dropdown-item link" href="/posrecords?terminal_location=Fido Swali">Fido Swali  </a>
            <a class="dropdown-item link " href="/posrecords?terminal_location=Fido Kpansia">Fido Kpansia  </a>
            <a class="dropdown-item link" href="/posrecords?terminal_location=Fido Obunna">Fido Obunna </a>
            <a class="dropdown-item" href="/posrecords?terminal_location=Fido Yenegwe">Fido Yenegwe  </a>
          </div>
        </button>
      </div>

        <!-- <form action="/search" method="GET">
        <div class="input-group">
        <select name="search" class="form-control form-control">    
            <option selected>Filter By</option>
            <option> Bank</option>
            <option> terminal location</option>
        </select>
        </div>
        <button type="submit" class="btn btn-default" ></button>
        </form> -->
    <table class="table table-striped responsive">
        <thead>
          <tr>
          <td scope="col">S/N</td>
            <!-- <th scope="col">Customers Name</th> -->
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
      @if($posrecord->count() > 0)
         @foreach($posrecord as $record)
            <tr>
            <td>{{($posrecord->currentpage()-1) * $posrecord->perpage() + $loop->index + 1}}</td>
            <!-- <td>{{$record->customer->name}}</td> -->
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
              <td><a class="btn btn-default"href="/posrecords/{{$record->id}}/edit">Edit</a> </td>
              <td><form action="/posrecords/{{$record->id}}" method="POST" >
              @method('delete')
              @csrf
              <button type ="submit" class="btn btn-danger">Delete</button>
              </form></td>
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
     
      {{ $posrecord->links() }}
@endsection