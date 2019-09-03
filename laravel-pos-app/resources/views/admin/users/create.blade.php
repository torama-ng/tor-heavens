@extends('layouts.app')


@section('content')



   <div class="card">
      <div class="card-header">
          Create a new Admin
      </div>


      <div class="card-body">
      <form action="{{ route('admins.store') }}" method="post">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Name</label>

                <input type="text" name="name" class="form-control">
            </div>

            <div class="form-group">
                    <label for="name">Email</label>
    
                    <input type="email" name="email" class="form-control">
            </div>
           

            <div class="form-group">
                <div class="text-center">
                    <button class="btn btn-success" type="submit">
                        Add Admin
                    </button>
                </div>
            </div>

            
      </form>
    </div>
  </div>
        

@endsection

 

