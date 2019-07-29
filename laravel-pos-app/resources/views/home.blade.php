@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class=" justify-content-center"> 
                    <a class="btn btn-primary"href="{{ route('customers') }}">Add Customers</a> 
                    <a class="btn btn-primary"href="{{ route('posrecords') }}">Pos Records</a>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
