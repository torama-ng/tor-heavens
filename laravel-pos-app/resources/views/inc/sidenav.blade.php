@guest
 @else
<div id="mySidenav" class="sidenav">
    <img class="img-responsive ml-4" src="uploads/profile_pics/{{$user->avatar}}" style ="width:200px; height:150px; border-radius:50%; "  >
    <ul class="list-group borderless mt-5">
      <li class="text-center borderless lis"><a href="{{ route('posrecords') }}">Pos Records</a></li>
      <div class="dropdown-divider" ></div>
      <li class=" text-center borderless lis"><a href="{{ route('customers') }}">Customers</a></li> 
      <div class="dropdown-divider"></div>  
      <li class="text-center borderless lis"><a href="{{ route('home') }}">Profile</a></li>
      <div class="dropdown-divider"></div>
      <li class=" text-center borderless lis"><a href="#">Contacts</a></li>
    </ul>
 
    </div>
    @endguest