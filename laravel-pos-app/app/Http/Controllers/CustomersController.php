<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomersController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        return view('customers.customers');
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
