@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            Admins
        </div>
          
      <div class="card-body">
        <table class="table table-hover">
            <thead>
               

                <th>
                    Name
                </th>
                    
                <th>
                    Permissions
                </th>

                <th>
                    Delete
                </th>
            </thead>
                 
            <tbody>
                @if($users->count() > 0)
                    @foreach($users as $user)
                        <tr>
                           
                            <td>
                                {{ $user->name }}
                            </td>

                            <td>
                                @if($user->admin)
                                    <a href="{{ route('admins.not.admin', ['id' => $user->id]) }}" class="btn btn-sm btn-danger">Remove Permissions</a>
                                @else
                                    <a href="{{ route('admins.admin', ['id' => $user->id]) }}" class="btn btn-sm btn-success">Make Admin</a>
                                @endif
                            </td>

                            <td>
                                @if(Auth::id() !== $user->id)
                                    <a href="{{ route('admins.delete', ['id' => $user->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                                @endif
                            </td>
                            
                        </tr>
                    @endforeach
                @else
                    <tr>
                      <th colspan="5" class="text-center">No users</th>
                    </tr>
                @endif
            </tbody>
        </table>
      </div>
    </div>

@stop

