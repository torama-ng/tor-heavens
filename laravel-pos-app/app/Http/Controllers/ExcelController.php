<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Excel;
use App\Posrecord;
use DB;
use App\Customer;
use App\User;


class ExcelController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);
        $this->middleware('admin');
    }

    public function create(){
        $user = Auth::user();
        return view('excel.excel', compact('user') );

    }

    public function store(Request $request){
        $this->validate($request,[
            'select_file' => 'required|mimes:xls,xlsx,csv',
        ]);

        $path = $request->file('select_file')->getRealPath();
    
      try {
        $data = Excel::load($path)->get();
        
        if(count($data) > 0 ){

            foreach($data->toArray() as $key => $value){

                foreach($value as $row){
                   
                    // $user = Auth::user();
                    // $user->id = $value['user_id'];
                    // get customer id from customer name in customer table
                    // or create customer in customer table and get id
                    $c_rec = Customer::all()->where('name', $row['customers_name'])->first();
                    // dd($c_id);
                    if($c_rec == true){
                        $c_id = $c_rec->id;
                        
                    } else {
                        // create this customer in customer table
                        $customer = new Customer();
                        $customer->name = $row['customers_name'];
                        $customer->phone = $row['customer_phone'];
                        $customer->user_id = auth()->user()->id;
                        $customer->save();
                        $c_id= Customer::all()->where('name', $row['customers_name'])
                        ->first()->id;
                    }
                      
                        
                    
                    
                    $insert_data = array(
                        'user_id' => $user_id = auth()->user()->id,
                        // 'customers_name' => $row['customers_name'],
                        'customer_id'   => $c_id,
                        'customers_name' => $c_id,
                        'amount' => $row['amount'],
                        'bank' => $row['bank'],
                        'card_number' => $row['card_number'],
                        'trans_id' => $row['trans_id'],
                        'terminal_location' => $row['terminal_location'],
                        'trans_date_time' => $row['trans_date_time'],
                        'action_taken' => $row['action_taken'],
                        'remarks' => $row['remarks'],
                        'avater' => $row['avater'],
                        'fido_fluids' => $row['fido_fluids'],
                        'fido_water' => $row['fido_water'],
                        'reply_mail' => $row['reply_mail'],

                        
                    );
                    
                    if(!empty($insert_data)){
                        // $insert_data = new Posrecord();
                        // $insert_data->save();
                        Posrecord::insert($insert_data);
                       // DB::table('posrecords')->insert($insert_data);
                    }

                    
                }
                
            }

            
        }
    } catch (\Exception $e) {
        if($e){ return redirect ('/import')->with('failure', 'File not imported, fields did not matched the format given below ');}
    
    }
        
   
    return redirect ('/posrecords')->with('success', 'Record imported Successfully')->with('customer_id',$c_id);
    }
}
