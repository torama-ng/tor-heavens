@extends('layouts.app')

@section('content')
<div>{{$errors->first('select_file')}}</div>
<form action="{{route('import')}}" method="POST" enctype="multipart/form-data" >
    <label>Import Excel file</label>
    <input type="file" name="select_file">
    <input type ="hidden" name="_token" value="{{csrf_token()}}">
    <br>
    <input type="submit" value="import" class ="btn btn-md btn-primary m-2">
</form>

@endsection