@extends('layouts.app')

@section('content')

<div class=" row justify-content-center"><h5 class="text-center col-md-6">POS RECORDS FORM</h4></div>

    <form action="/posrecords/{{$posrecord->id}}" class="py-1" method="POST" enctype="multipart/form-data" >
   @method('patch')
    <div class="form-row justify-content-center">
        <div class="form-group col-md-6 ">
        <label> Customers Name</label>
        <select name="customers_name" class="form-control form-control"> 
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
  <input name="amount" type="text" value="{{$posrecord->amount}}"class="form-control form-control"  placeholder="Enter Amount">
        <div>{{$errors->first('amount')}}</div>
    </div>

     <div class="form-group col-md-3" >
        <label >Bank</label>
        <select name="bank" class="form-control form-control">
                <option selected>{{$posrecord->bank}}</option>
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
        <input name="card_number" type="text" value="{{$posrecord->card_number}}" class="form-control form-control"  placeholder="Enter Card Number">
        <div>{{$errors->first('card_number')}}</div>
    </div>

    <div class="form-group col-md-3" >
            <label >Transacton ID</label>
            <input name="trans_id" type="text" value="{{$posrecord->trans_id}}"class="form-control form-control"  placeholder="Enter Transaction ID">
            <div>{{$errors->first('trans_id')}}</div>
        </div> 
  </div> 
 
    <div class="form-row justify-content-center">   
     <div class="form-group col-md-3">
        <label >Terminal Location</label>
        <select name="terminal_location" class="form-control form-control">
            <option selected>{{$posrecord->terminal_location}}</option>
            <option> Fido Okutukutu</option>
            <option> Fido Swali</option>
            <option> Fido Kpansia</option>
            <option> Fido Obunna</option>
            <option> Fido Yenegwe</option>
        </select>
        </div>
        
        <div class="form-group col-md-3" >
            <label >Transaction Date</label>
            <input name="trans_date_time" type="datetime-local" value="{{ $posrecord->trans_date_time }}" class="form-control form-control"> 
            <div>{{$errors->first('trans_date_time')}}</div>
        </div>
    </div>
    <div class="form-row justify-content-center">
        <div class="form-group col-md-6">
        <label> Action Taken</label>
        <select name="action_taken" class="form-control form-control">    
            <option selected>{{$posrecord->action_taken}}</option>
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
        <textarea name="remarks" class="form-control" rows="3" >{{ $posrecord->remarks }}</textarea>
        <div>{{$errors->first('remarks')}}</div>
    </div>
    </div>

  <div class="form-row justify-content-center"> 
  <button type="submit" class="btn btn-primary col-md-3">Update Record</button>
  </div>
  @csrf
</form>

@endsection