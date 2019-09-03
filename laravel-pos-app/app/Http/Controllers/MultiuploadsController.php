<?php

namespace App\Http\Controllers;
use Auth;
use User;
use Image;

use Illuminate\Http\Request;

class MultiuploadsController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware(['auth' => 'verified']);
        $this->middleware('admin');
    }


    public function store(Request $request){
        $this->validate($request,[
            'avatar' => 'required|max:5999'
        ]);
        
            $files = $request->file('avatar');
            if(!empty($files)){
                foreach($files as $file){
                Image::make($file)->resize(300, 300)->save(public_path('/uploads/avater/' . $file->getClientOriginalName())); 
                }
            }
        
        // if($request->hasFile('avatar')){
        //     $avatar = $request->file('avatar')->getClientOriginalName();
        //     $fileName = pathinfo($avatar, PATHINFO_FILENAME);
        //     $extension =  $request->file('avatar')->getClientOriginalExtension();
        //     $fileToStore = 
        //     Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avater/' . $fileName));
        // }

        return redirect ('/posrecords')->with('success', 'Photos Uploaded Successfully');
    }
}
