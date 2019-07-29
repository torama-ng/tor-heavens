<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Posrecord;
use Image;
use App\User;
class PosrecordsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $userrecords = $user->posrecord; //gives all posrecords of a user
        $posrecords = Posrecord::orderBy('created_at','desc')->paginate(5);
        return view('pos.posrecords', compact('posrecords', 'userrecords'));

    }


    public function create(){
        $customers = Customer::all();
        return view('pos.posrecordcreate', compact('customers'));
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
            'avater' =>'file|image|nullable|max:5000',
        ]);

        if($request->hasFile('avater')){
            $avater = $request->file('avater');
            $fileName = time() . '.' . $avater->getClientOriginalExtension();
            Image::make($avater)->resize(300, 300)->save(public_path('/uploads/avater/' . $fileName));
        }else{
            $fileName = "default.jpg";
        }

        $posrecord = new Posrecord();
        $posrecord->customers_name = request('customers_name');
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
}