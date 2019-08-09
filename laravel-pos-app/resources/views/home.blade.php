@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <h4 class="text-center">Update Profile</h4>
                <div class="row">
                <div class="col-md-4">
                <img src="uploads/profile_pics/{{ $user->avatar }}" style ="width:200px; height:150px; border-radius:58%;"  >
                </div>
                <div class="col-md-8 colmd-offset-1 p-4">
                <h4> {{$user->name}} profile </h4>
                <form enctype="multipart/form-data" action="home" method="POST">
                    <label>Update Profile Image</label>
                    <input type="file" name="avatar">
                    <input type ="hidden" name="_token" value="{{csrf_token()}}">
                    <br>
                    <input type="submit" class ="btn btn-md btn-primary m-2">
                </form>
                </div>
                </div>
            </div>
        </div>
</div>
</div>
@endsection
