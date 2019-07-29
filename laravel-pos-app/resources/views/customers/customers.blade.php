@extends('layouts.app')

@section('content')
<div class=" row justify-content-center"><h5 class="text-center col-md-6">Add Customers</h4></div>
<form action="{{route('customers')}}" method="POST" >
        <div class="form-row justify-content-center">
            <div class="form-group col-md-6">
              <label >Customer's Name</label>
              <input name="name" type="text" value="{{old('name')}}"class="form-control" id="inputEmail4" placeholder="Customers name" >
            <div>{{$errors->first('name')}}</div>
            </div>  
          </div>
        <div class="form-row justify-content-center">
        <div class="form-group col-md-6">
            <label >Phone</label>
            <input name="phone" type="text" value="{{old('phone')}}"class="form-control" id="inputEmail4" placeholder="Enter Phone" >
        <div>{{$errors->first('phone')}}</div>
          </div>  
        </div>
        <div class="form-row justify-content-center">
        <div class="form-group col-md-6">
            <label >Address</label>
            <input name="address" type="text" value="{{old('address')}}"class="form-control" id="inputEmail4" placeholder="Enter Address" >
        <div>{{$errors->first('address')}}</div>
          </div>  
        </div>
    
          <div class="form-row justify-content-center"> 
          <button type="submit" class="btn btn-primary col-md-3">Add Customer</button>
          </div>
          @csrf
        </form>
@endsection