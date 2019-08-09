<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/posrecords';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        //try connect if fail redirect to login
        try {
            $guser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->route('login');
        }
        
        //check for user
        $user = User::where('provider_id', $guser->getId())->first();
       
        //add user to database
        if(!$user){
        $user = new User();
        $user->name = $guser->getName();
        $user->email = $guser->getEmail();
        $user->email_verified_at = now();
        $user->provider_id = $guser->getId();
        $user->save();
        }
        //login user
        Auth::login($user,true);
        


        return redirect($this->redirectTo);
       
        //dd($user);
       //return $user->token;
        //$user->token;
        // $user->name;
    }
}
