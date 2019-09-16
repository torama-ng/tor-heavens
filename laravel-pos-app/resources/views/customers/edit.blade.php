@extends('layouts.app')

@section('content')
<div class=" row justify-content-center"><h5 class="text-center col-md-6">Add Customers</h4></div>
<form action="/customers/{{$customer->id}}" method="POST" >
        @method('patch')
        <div class="form-row justify-content-center">
            <div class="form-group col-md-3">
              <label >Customer's Name</label>
              <input name="name" type="text" value="{{$customer->name}}"class="form-control" id="inputEmail4" placeholder="Customers name" >
            <div>{{$errors->first('name')}}</div>
            </div>  
            
            <div class="form-group col-md-3">
            <label >Phone</label>
            <input name="phone" type="text" value="{{$customer->phone}}"class="form-control" id="inputEmail4" placeholder="Enter Phone" >
            <div>{{$errors->first('phone')}}</div>
          </div>  

          <div class="form-group col-md-3">
            <label >Address</label>
            <input name="address" type="text" value="{{$customer->address}}"class="form-control" id="inputEmail4" placeholder="Enter Address" >
            <div>{{$errors->first('address')}}</div>
          </div> 
          <div class="form-group col-md-3">
          <br>
          <button type="submit" class=" mt-2 btn btn-primary">Update Customer</button>
          </div> 
          </div>
        
          @csrf
        </form>
        
@endsection