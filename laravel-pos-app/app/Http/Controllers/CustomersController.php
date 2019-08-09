<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Customer;

class CustomersController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        $user = Auth::user();
        $customer = Customer::orderBy('created_at','desc')->paginate(5);
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
        $customer->save();

        return redirect('/posrecords')->with('success', 'Customer added successfully');

    }
}
