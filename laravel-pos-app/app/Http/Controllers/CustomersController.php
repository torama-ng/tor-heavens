<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Customer;

class CustomersController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        $user = Auth::user();
        $user_id = auth()->user()->id;
        $user_email = auth()->user()->email;

        if($user_email == "admin@torama.ng"){
            $customer = Customer::orderBy('created_at','desc')->paginate(7);
        }else{
            $customer = Customer::where('user_id',$user_id)->paginate(5);
        }
        
        return view('customers.customers', compact('customer', 'user'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'phone' => '',
            'address' => '',
        ]);

        $customer = new Customer();
        $customer->name = request('name');
        $customer->phone = request('phone');
        $customer->address = request('address');
        $customer->user_id = auth()->user()->id;
        $customer->save();

        return redirect('/posrecords')->with('success', 'Customer added successfully');

    }
}
