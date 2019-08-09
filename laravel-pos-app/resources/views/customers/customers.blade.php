@extends('layouts.app')

@section('content')
<div class=" row justify-content-center"><h5 class="text-center col-md-6">Add Customers</h4></div>
<form action="{{route('customers')}}" method="POST" >
        <div class="form-row justify-content-center">
            <div class="form-group col-md-3">
              <label >Customer's Name</label>
              <input name="name" type="text" value="{{old('name')}}"class="form-control" id="inputEmail4" placeholder="Customers name" >
            <div>{{$errors->first('name')}}</div>
            </div>  
            
            <div class="form-group col-md-3">
            <label >Phone</label>
            <input name="phone" type="text" value="{{old('phone')}}"class="form-control" id="inputEmail4" placeholder="Enter Phone" >
            <div>{{$errors->first('phone')}}</div>
          </div>  

          <div class="form-group col-md-3">
            <label >Address</label>
            <input name="address" type="text" value="{{old('address')}}"class="form-control" id="inputEmail4" placeholder="Enter Address" >
            <div>{{$errors->first('address')}}</div>
          </div> 
          <div class="form-group col-md-3">
          <br>
          <button type="submit" class="btn btn-primary">Add Customer</button>
          </div> 
          </div>
        
          @csrf
        </form>
        <table class="table table-striped responsive">
        <thead>
          <tr>
          <td scope="col">S/N</td>
            <th scope="col">Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Address</th>
            <th scope="col">ID</th>
            
          </tr>
        </thead>
        <tbody id="myTable">
      @if($customer->count() > 0)
         @foreach($customer as $cus)
            <tr>
            <td>{{($customer->currentpage()-1) * $customer->perpage() + $loop->index + 1}}</td>
            <td>{{$cus->name}}</td>
            <td>{{$cus->phone}}</td>
            <td>{{$cus->addres}}</td>
            <td>{{$cus->id}}</td>
            </div>
          @endforeach
         

          @else 
          <p>No Customer found</p>
          @endif
         
        </tbody>
        
      </table>
      
      {{ $customer->links() }}
@endsection