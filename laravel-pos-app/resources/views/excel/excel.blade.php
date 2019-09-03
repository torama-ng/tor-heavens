@extends('layouts.app')

@section('content')
<div class="form-row justify-content-center">
<div>{{$errors->first('select_file')}}</div>
<form action="{{route('import')}}" method="POST" enctype="multipart/form-data" >
<div class="form-group col-md-6 ">
    <label>Import Excel file</label>
    <input class="" type="file" name="select_file">
    <input type ="hidden" name="_token" value="{{csrf_token()}}">
    <br>
    </div>
    <input type="submit" value="import" class ="btn btn-md btn-primary m-2">
</form>
<!-- Upload Multiple Images -->
<div>{{$errors->first('avatar')}}</div>
    <form enctype="multipart/form-data" action="multiuploads" method="POST">   
    <div class="form-group col-md-6 ">
        <label>Upload Multiple Image</label>
        <input type="file" name="avatar[]" multiple/>
        <input type ="hidden" name="_token" value="{{csrf_token()}}">
        <br>
    </div>
        <input type="submit" class ="btn btn-md btn-info m-2" value="Upload">
   
    </form>

</div>
<p class="ml-4 text-justify bg-default font-weight-normal mt-5">Please follow the format given below and make sure customers_name, amount, bank, card_number, trans_id, terminal_location,action_taken,remarks,avater and customer_phone are filled in the first row of your excel file.</p>

<img class="img-responsive ml-4 mt-1" src="uploads/avater/example.png" style ="width:100%; height:150px; "  >
@endsection