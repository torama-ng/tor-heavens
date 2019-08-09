<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Customer;
use App\Posrecord;
use Image;
use App\User;
class PosrecordsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);
    }



    public function index(){
        $user = Auth::user();
        $user_id = auth()->user()->id;
        $user_email = auth()->user()->email;
        // $user = User::find($user_id);
        // $userrecords = $user->posrecord; //gives all posrecords of a user
        //  $posrecords = Posrecord::find('user_id', $user->posrecord)->orderBy('created_at','desc')->paginate(10);
       //  $posrecords = Posrecord::orderBy('created_at','desc')->paginate(10);
       //$posrecord = Posrecord::where('user_id', '1')->paginate(10);
       
       //check for admin
       if($user_email == "admin@torama.ng"){
        $posrecord = Posrecord::orderBy('created_at','desc')->paginate(10);
             
       }else{
        //users
       $posrecord = Posrecord::where('user_id', $user_id)->paginate(6);
       $pos_rec = $posrecord;
       }
       
       
       //display filter count
       $bank_count = Posrecord::with('bank')->count();
       $loc_count = Posrecord::with('terminal_location')->count();
       
       //filtering
       if(request()->has('bank')){  
        $posrecord = Posrecord::where('bank', request('bank'))->paginate(5);
        }
        if(request()->has('terminal_location')){
        $posrecord = Posrecord::where('terminal_location', request('terminal_location'))->paginate(5);
        }
       
        //dd($userrecords);
        return view('pos.posrecords', compact( 'posrecord', 'bank_count','loc_count','user'));
        // return view('pos.posrecords', compact( 'userrecords','posrecords'));

    }


    public function create(){
        $customers = Customer::all();
        return view('pos.posrecordcreate', compact('customers'));
    }

    public function search(Request $request){
        $search = $request->get('search');
        $posrecord = Posrecord::where('bank', 'like', '%'.$search.'%')
                                ->orWhere('terminal_location','like', '%'.$search.'%')
                                ->paginate(5);
        return view('pos.posrecords', compact('posrecord'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'customers_name' => 'required',
            'amount' => 'required',
            'bank' => 'required',
            'card_number' => 'required',
            'trans_id' => 'required',
            'terminal_location' => 'required',
            'trans_date' => 'required',
            'action_taken' => 'required',
            'remarks' => '',
            'avater' =>'|file|image|nullable|max:5000',
        ]);

        if($request->hasFile('avater')){
            $avater = $request->file('avater');
            $fileName = time() . '.' . $avater->getClientOriginalExtension();
            Image::make($avater)->resize(300, 300)->save(public_path('/uploads/avater/' . $fileName));
        }else{
            $fileName = "default.jpg";
        }

        $posrecord = new Posrecord();
        $customer_name = $posrecord->customers_name = request('customers_name');

        $customer = Customer::all()->where('name',$customer_name);
        // dd($customer->first()->id;
        $customer_id =         $customer->first()->id;
        $posrecord->customer_id = $customer_id;
        $posrecord->amount = request('amount');
        $posrecord->bank = request('bank');
        $posrecord->card_number = request('card_number');
        $posrecord->trans_id = request('trans_id');
        $posrecord->terminal_location = request ('terminal_location');
        $posrecord->trans_date = request ('trans_date');
        $posrecord->action_taken = request('action_taken');
        $posrecord->remarks = request('remarks');
        $posrecord->avater = $fileName;
        $posrecord->user_id = auth()->user()->id; //gets the currrent user id 
        $posrecord->save();
        
        return redirect ('/posrecords')->with('success', 'Record added Successfully');

    }

    public function edit($posrecord){
        $customers = Customer::all();
        $posrecord= Posrecord::find($posrecord);
        return view('pos.edit', compact('customers','posrecord'));
    }

    public function update(Request $request, $posrecord){
        $this->validate($request, [
            'customers_name' => 'required',
            'amount' => 'required',
            'bank' => 'required',
            'card_number' => 'required',
            'trans_id' => 'required',
            'terminal_location' => 'required',
            'trans_date' => 'required',
            'action_taken' => 'required',
            'remarks' => '',
            'avater' =>'|file|image|nullable|max:5000',
        ]);

        if($request->hasFile('avater')){
            $avater = $request->file('avater');
            $fileName = time() . '.' . $avater->getClientOriginalExtension();
            Image::make($avater)->resize(300, 300)->save(public_path('/uploads/avater/' . $fileName));
        }else{
            $fileName = "default.jpg";
        }
        $posrecord= Posrecord::find($posrecord);
        $customer_name = $posrecord->customers_name = request('customers_name');

        $customer = Customer::all()->where('name',$customer_name);
        // dd($customer->first()->id;
        $customer_id =         $customer->first()->id;
        $posrecord->customer_id = $customer_id;

        $posrecord->amount = request('amount');
        $posrecord->bank = request('bank');
        $posrecord->card_number = request('card_number');
        $posrecord->trans_id = request('trans_id');
        $posrecord->terminal_location = request ('terminal_location');
        $posrecord->trans_date = request ('trans_date');
        $posrecord->action_taken = request('action_taken');
        $posrecord->remarks = request('remarks');
        $posrecord->avater = $fileName;
        $posrecord->user_id = auth()->user()->id; //gets the currrent user id 
        $posrecord->save();
        
        return redirect ('/posrecords')->with('success', 'Record Updated Successfully');


    }

    public function destroy($posrecord){
        $posrecord= Posrecord::find($posrecord);
        $posrecord->delete();
        return back()->with('success', 'Record Deleted Successfully');
    }

}