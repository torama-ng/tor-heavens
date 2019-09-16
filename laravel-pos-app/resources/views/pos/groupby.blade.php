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
              
              
              <h5 class="ml-4">Bank <span class="badge badge-secondary ">{{$bank_count}}</span></h5> 
              <div class="dropdown-divider"></div> 
              
              <a class="dropdown-item" href="/posrecords?bank=GTB">GTB </a>
              <a class="dropdown-item" href="/posrecords?bank=ACCESS">ACCESS </a>
              <a class="dropdown-item" href="/posrecords?bank=UBA">UBA </a>
              <a class="dropdown-item" href="/posrecords?bank=WEMA">WEMA  </a>
              <a class="dropdown-item" href="/posrecords?bank=FIRST">FIRST bank</a>
              <a class="dropdown-item" href="/posrecords?bank=FIDELITY">FIDELITY </a>
              <a class="dropdown-item" href="/posrecords?bank=ZENITH">ZENITH </a>
              
           
              <div class="dropdown-divider"></div>
              <h5 class="ml-4">Location <span class="badge badge-secondary ">{{$loc_count}}</span></h5> 
              <div class="dropdown-divider"></div> 
              
            <a class="dropdown-item link" href="/posrecords?terminal_location=OKUTUKUTU">OKUTUKUTU  </a>
              <a class="dropdown-item link" href="/posrecords?terminal_location=SWALI">SWALI  </a>
              <a class="dropdown-item link " href="/posrecords?terminal_location=KPANSIA">KPANSIA </a>
              <a class="dropdown-item link" href="/posrecords?terminal_location=OBUNNA">OBUNNA </a>
              <a class="dropdown-item" href="/posrecords?terminal_location=YENEGWE">YENEGWE  </a>
            </div>   
            </button>
  
       
          
          <button class="btn btn-default" >
            <a class=" dropdown-toggle" href="#" id="link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              GroupBy:<span class="badge badge-secondary "></span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/posrecord?bank">Bank </a>
                <a class="dropdown-item" href="/posrecord?terminal_location">Location </a>
              <a class="dropdown-item" href="/posrecord?customer_id">Customers ID</a>
              <a class="dropdown-item" href="/posrecord?trans_date_time">Date </a>
              <a class="dropdown-item" href="/posrecord?action_taken">Status </a>
              </div>
          </button>
      </div>
     <table class="table">
     
      @if(count($posrecords) > 0)
         
         @foreach($posrecords as $records => $record)

             <tr>
                 <td>
                 <details>
                   <summary>{{$records}}: {{$record->count()}}</summary>
                   <table class="table table-striped responsive">
                   <tr>
                   <th scope="col">Customers ID</th>
                   <th scope="col">Amount</th>
                   <th scope="col">Card No#</th>
                   <th scope="col">Bank</th>
                   <th scope="col">Trans ID</th>
                   <th scope="col">Terminal Location</th>
                   <th scope="col">Transaction Date</th>
                   <th scope="col">Status</th>
                   <th scope="col">Remarks</th>
                   <th scope="col">Photo</th>
                   <th scope="col">Edit</th>
                   </tr>
                   @foreach($record as $rec)
                   
                       <tr> 
                       <td>{{$rec->customer_id}}</td>
                       <td>{{$rec->amount}}</td>
                       <td>{{$rec->card_number}}</td>
                       <td>{{$rec->bank}}</td>
                       <td>{{$rec->trans_id}}</td>
                       <td>{{$rec->terminal_location}}</td>
                       <td>{{$rec->action_taken}}</td>
                       <td>{{$rec->remarks}}</td>
                       <td>{{$rec->trans_date_time}}</td>
                       {{-- <td>{{\Carbon\Carbon::parse($rec->trans_date_time)->format('d.m.y H:i:a')}}</td> --}}
                       <td><button class="btn-primary showuser" data-avatar="{{ $rec->avater}}" data-toggle="modal" data-target="#modalpix">image</button></td>
              <td><a class="btn btn-default"href="/posrecords/{{$rec->id}}/edit"><i class="fas fa-edit "></i></a> </td>
                       </tr>
                       <div class="modal fade" id="modalpix" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          
        
          </div>
                  @endforeach
                  </table>
                 </details>
                 </td>
             </tr>
             
      @endforeach
   

       @else 
       <p>No Pos Records found</p>
       @endif
       </table>    
@endsection