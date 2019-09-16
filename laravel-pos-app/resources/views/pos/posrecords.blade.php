@extends('layouts.app')

@section('content')
    <div class=" row justify-content-center">
        <h5 class="text-center col-md-6 lead">POS RECORDS</h4>
    </div>
  @if (session('success'))
          <div class="alert alert-success" role="alert">
              {{ session('success') }}
          </div>
      @endif
      @if (session('failure'))
          <div class="alert alert-danger" role="alert">
              {{ session('failure') }}
          </div>
      @endif
    <div class="row justify-content-center "> 
        
        <a class="btn btn-primary mx-1" href="{{ route('customers') }}">Add Customer</a> 
        <a class="btn btn-primary mr-1" href="{{ route('posrecords.create') }}">Add Record</a> 
        <a class="btn btn-info mr-1 " href="{{ route('import') }}">Import / Upload</a>
        
        <input class="form-control col-md-3" id="myInput" type="text" placeholder="Search.."> 
        
        <button class="btn btn-default" >
            <a class=" dropdown-toggle" href="#" id="link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            FilterBy  
            </a>
            
            <div class="dropdown-menu">
           
               
               
             
              
                
                <h6 class="ml-4">Location <span class="badge badge-secondary ">{{$loc_count}}</span></h5> 
                <div class="dropdown-divider"></div> 
                
              <a class="dropdown-item link" href="/posrecords?terminal_location=OKUTUKUTU">OKUTUKUTU  </a>
                <a class="dropdown-item link" href="/posrecords?terminal_location=SWALI">SWALI  </a>
                <a class="dropdown-item link " href="/posrecords?terminal_location=KPANSIA">KPANSIA </a>
                <a class="dropdown-item link" href="/posrecords?terminal_location=OBUNNA">OBUNNA </a>
                <a class="dropdown-item" href="/posrecords?terminal_location=YENEGWE">YENEGWE  </a>

           
                <div class="dropdown-divider"></div> 

                 <a class=" dropdown-toggle ml-4" href="#" id="link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Bank <span class="badge badge-secondary ">{{$bank_count}}</span>
                  </a>
                  <div class="dropdown-menu">
                     <a class="dropdown-item" href="/posrecords?bank=GTB">GTB </a>
                      <a class="dropdown-item" href="/posrecords?bank=ACCESS">ACCESS </a>
                      <a class="dropdown-item" href="/posrecords?bank=UBA">UBA </a>
                      <a class="dropdown-item" href="/posrecords?bank=WEMA">WEMA  </a>
                      <a class="dropdown-item" href="/posrecords?bank=FIRST">FIRST</a>
                      <a class="dropdown-item" href="/posrecords?bank=FIDELITY">FIDELITY </a>
                      <a class="dropdown-item " href="/posrecords?bank=ZENITH">ZENITH </a>
                    </div>
                
              </div> 
                
              </button>
    
          
          <button class="btn btn-default" >
            <a class=" dropdown-toggle" href="#" id="link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              GroupBy:<span class="badge badge-secondary "></span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/posrecord?bank">Bank </a>
                <a class="dropdown-item" href="/posrecord?terminal_location">Location </a>
                <a class="dropdown-item" href="/posrecord?customer_id">Customers Name </a>
                <a class="dropdown-item" href="/posrecord?trans_date_time">Date </a>
                <a class="dropdown-item" href="/posrecord?action_taken">Status </a>
                <a class="dropdown-item" href="/posrecords">Clear</a>
              </div>
          </button>
      </div>
      
      
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
            <th scope="col">Transaction Date_Time</th>
            <th scope="col">Status</th>
            <th scope="col">Remarks</th>
            <th scope="col">customer ID</th>
            <th scope="col">Fido Fluids</th>
            <th scope="col">Fido Water</th>
            <th scope="col">Reply Mail</th>
            <th scope="col">Photo</th>
            <th scope="col">Edit</th>
            
            
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
            <td>{{$record->trans_date_time}}</td>
            {{-- <td>{{\Carbon\Carbon::parse($record->trans_date_time)->format('d.m.y H:i:a')}}</td> --}}
            <td>{{$record->action_taken}}</td>
            <td>{{$record->remarks}}</td>
            <td>{{$record->customer->id}}</td>
            <td>{{$record->fido_fluids}}</td>
            <td>{{$record->fido_water}}</td>
            <td>{{$record->reply_mail}}</td>
            <td><button class="btn-primary showuser" data-avatar="{{ $record->avater}}" data-toggle="modal" data-target="#modalpix">
              image</button></td>
              <td><a class="btn btn-default"href="/posrecords/{{$record->id}}/edit"><i class="fas fa-edit "></i></a> </td>
              <!-- <td><form action="/posrecords/{{$record->id}}" method="POST" >
              @method('delete')
              @csrf
              <button type ="submit" class="btn btn-default "><i class="fas fa-trash " ></i></button>
              </form></td> -->
          </tr>
         <!-- Modal -->
      <div class="modal fade" id="modalpix" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            
      </div>
          @endforeach
         

          @else 
          <div class="alert alert-success" role="alert">
          <p>No Pos Records found</p>
          </div>
          @endif
        
        </tbody>
        
      </table>
      
      {{ $posrecord->links() }}
@endsection