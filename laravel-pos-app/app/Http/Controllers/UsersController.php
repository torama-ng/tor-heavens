<?php

namespace App\Http\Controllers;

use Session;

use App\User;

use App\middleware\SuperAdmin;
use Illuminate\Http\Request;

class UsersController extends Controller
{
     public function __construct()
     {
         $this->middleware('superadmin');
         
     }
    

    public function index()
    {
        $admin = User::where('admin', '1')->get();

        if($admin == '1'){
        $admin = User::where('admin', '1')->get();
        }else{
        $users = User::all();
        }
        return view('admin.users.index',compact( 'admin','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'name' => 'required',
            'email' => 'required|email',
            
        ]);

        $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'admin' => $request->admin,
            'password' => bcrypt('password')
        ]);


        Session::flash('success', 'Admin added successfully.');

        return redirect()->route('admins');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->profile->delete();

        $user->delete();

        Session::flash('success', 'User deleted.');

        return redirect()->back();
    }

    public function admin($id) {

        $user = User::find($id);

        $user->admin = 1;

        $user->save();

        Session::flash('success', 'Successfully changed user permission.');

        return redirect()->back();
    }

    public function not_admin($id) {

        $user = User::find($id);

        $user->admin = 0;

        $user->save();

        Session::flash('success', 'Successfully changed user permission.');

        return redirect()->back();
    }
}
