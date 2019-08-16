<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use User;
use Image;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware(['auth' => 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('profile', array('user' => Auth::user()));
    }

        public function update_avatar(Request $request){

            if($request->hasFile('avatar')){
                $avatar = $request->file('avatar');
                $fileName = time() . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/profile_pics/' . $fileName));
                $user = Auth::user();
                $user->avatar = $fileName;
                $user->save();
            }

            return view('profile', array('user' => Auth::user()));
        }
}
