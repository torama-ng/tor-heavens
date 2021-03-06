<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use App\User;
use App\Customer;
use App\Posrecord;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PosrecordsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);
        $this->middleware('admin',['except' =>['index']]);

    }



    public function index(){
        $user = Auth::user();
        $user_id = auth()->user()->id;
        $admin = auth()->user()->admin;
        $user_email = auth()->user()->email;
        // $user = User::find($user_id);
        // $userrecords = $user->posrecord; //gives all posrecords of a user
        //  $posrecords = Posrecord::find('user_id', $user->posrecord)->orderBy('created_at','desc')->paginate(10);
       //  $posrecords = Posrecord::orderBy('created_at','desc')->paginate(10);
       //$posrecord = Posrecord::where('user_id', '1')->paginate(10);
       //display filter count
      
       
    
       //check for admin
       if($user_id == "1"){
        $posrecord = Posrecord::orderBy('created_at','desc')->paginate(25);
          
       }
       elseif($admin == "1"){
        //users
       $posrecord = Posrecord::where('user_id', $user_id)->orderBy('created_at','desc')->paginate(25);
       $pos_rec = $posrecord;
       }
       else{
        $posrecord = Posrecord::orderBy('created_at','desc')->paginate(25); 
       }
       $bank_count = Posrecord::where('user_id', $user_id)->with('bank')->count();
       $loc_count = Posrecord::where('user_id', $user_id)->with('terminal_location')->count();
       
  

       //filtering
       if(request()->has('bank')){  
           $posrecord = Posrecord::where('bank', request('bank'))->paginate(25);
           return view('pos.posrecords', compact( 'posrecord', 'bank_count','loc_count','user'));
           }
           if(request()->has('terminal_location')){
           $posrecord = Posrecord::where('terminal_location', request('terminal_location'))->paginate(25);
           return view('pos.posrecords', compact( 'posrecord', 'bank_count','loc_count','user'));
           }
        
          
        //dd($userrecords);
        return view('pos.posrecords', compact( 'posrecord', 'bank_count','loc_count','user'));
        // return view('pos.posrecords', compact( 'userrecords','posrecords'));

    }
    public function groupby(){
        $user = Auth::user();
        $user_id = auth()->user()->id;
        $admin = auth()->user()->admin;
        $user_email = auth()->user()->email;

        if($user_id == "1"){
            $posrecord = Posrecord::orderBy('created_at','desc')->paginate(25);
              // return 123;  
           }
           elseif($admin == "1"){
            //users
           $posrecord = Posrecord::where('user_id', $user_id)->orderBy('created_at','desc')->paginate(25);
           $pos_rec = $posrecord;
           }
           else{
            $posrecord = Posrecord::orderBy('created_at','desc')->paginate(25); 
           }
           $bank_count = Posrecord::where('user_id', $user_id)->with('bank')->count();
           $loc_count = Posrecord::where('user_id', $user_id)->with('terminal_location')->count();
           
         //grouping
    if(request()->has('trans_date_time')){  
        $posrecords  = Posrecord::orderBy('created_at')->get()->groupBy('trans_date_time');
        return view('pos.groupby', compact( 'posrecords', 'bank_count','loc_count','user'));
       // dd($rec);
     }
     elseif(request()->has('bank')){  
        $posrecords = Posrecord::orderBy('created_at')->get()->groupBy('bank');
        return view('pos.groupby', compact( 'posrecords', 'bank_count','loc_count','user'));
       // dd($rec);
     }
     elseif(request()->has('terminal_location')){  
        $posrecords = Posrecord::orderBy('created_at')->get()->groupBy('terminal_location' );
        return view('pos.groupby', compact( 'posrecords', 'bank_count','loc_count','user'));
       // dd($rec);
     }
     elseif(request()->has('customer_id')){  
        $posrecords = Posrecord::orderBy('created_at')->get()->groupBy('customer_id');
        return view('pos.groupby', compact( 'posrecords', 'bank_count','loc_count','user'));
       // dd($rec);
     }
     elseif(request()->has('action_taken')){  
        $posrecords  = Posrecord::orderBy('created_at')->get()->groupBy('action_taken');
        return view('pos.groupby', compact( 'posrecords', 'bank_count','loc_count','user'));
       // dd($rec);
     }
    else {
        $posrecord  = Posrecord::orderby('created_at')->paginate(25);
      
    }    
    }

    public function create(){
        $user = Auth::user();
        $customers = Customer::all();
        return view('pos.posrecordcreate', compact('customers','user'));
    }

    

    public function store(Request $request){
        $this->validate($request, [
            'customers_name' => 'required',
            'amount' => 'required',
            'bank' => 'required',
            'card_number' => 'required',
            'trans_id' => 'required',
            'terminal_location' => 'required',
            'trans_date_time' => 'required',
            'action_taken' => 'required',
            'remarks' => '',
            'avater' =>'|file|image|nullable|max:5000',
            'fido_fluids' => 'required',
            'fido_water' => 'required',
            'reply_mail' => 'required',
        ]);

        if($request->hasFile('avater')){
            $avater = $request->file('avater');
            $fileName = time() . '.' . $avater->getClientOriginalExtension();
            Image::make($avater)->resize(300, 300)->save(public_path('/uploads/avater/' . $fileName));
        }else{
            $fileName = "default.jpg";
        }

        $c_rec = Customer::all()->where('name', request('customers_name'))->first();
        // dd($c_id);
        if($c_rec == true){
            $c_id = $c_rec->id;
            
        } else {
            // create this customer in customer table
            $customer = new Customer();
            $customer->name = request('customers_name');
            $customer->user_id = auth()->user()->id;
            $customer->save();
            $c_id= Customer::all()->where('name', request('customers_name'))
            ->first()->id;
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
        $posrecord->trans_date_time = request ('trans_date_time');
        $posrecord->action_taken = request('action_taken');
        $posrecord->remarks = request('remarks');
        $posrecord->fido_fluids = request('fido_fluids');
        $posrecord->fido_water = request('fido_water');
        $posrecord->reply_mail = request('reply_mail');
        $posrecord->avater = $fileName;
        $posrecord->user_id = auth()->user()->id; //gets the currrent user id 
        $posrecord->save();
        
        return redirect ('/posrecords')->with('success', 'Record added Successfully');

    }

    public function edit($posrecord){
        $user = Auth::user();
        $customers = Customer::all();
        $posrecord = Posrecord::find($posrecord);
        return view('pos.edit', compact('customers','posrecord', 'user'));
    }

    public function update(Request $request, $posrecord){
        $this->validate($request, [
            'customers_name' => 'required',
            'amount' => 'required',
            'bank' => 'required',
            'card_number' => 'required',
            'trans_id' => 'required',
            'terminal_location' => 'required',
            'trans_date_time' => 'required',
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
        //$posrecord->trans_time = request('trans_time');
        $posrecord->trans_date_time = request ('trans_date_time');
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