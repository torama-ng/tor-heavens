@guest
 @else
<div id="mySidenav" class="sidenav">
    <img class="img-responsive ml-4" src="uploads/profile_pics/{{$user->avatar}}" style ="width:200px; height:150px; border-radius:30%; "  >
    <ul class="list-group borderless mt-4">
      <li class="borderless lis"><a href="{{ route('posrecords') }}"><i class=" mx-4 far fa-file-excel"></i>Pos Records</a></li>
      <div class="dropdown-divider bg-inverse" ></div>
      <li class=" borderless lis"><a href="{{ route('customers') }}"><i class=" mx-4 fas fa-users"></i>Customers</a></li> 
      <div class="dropdown-divider"></div>  
      <li class="borderless lis"><a href="{{ route('profile') }}"><i class="mx-4 fas fa-id-badge"></i> Profile</a></li>
      <div class="dropdown-divider"></div>
      <li class="  borderless lis mb-5"><a href="#"><i class="mx-4 far fa-address-book"></i>Contacts</a></li>
    </ul>
 
    </div>
    @endguest