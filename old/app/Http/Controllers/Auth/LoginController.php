<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {
        $input = $request->all();
        // return $request->all();
        // $remember_me = $request->has('remember') ? true : false;



        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // if(isset($request->remember_me))
        // $remember_me = true;
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            if(auth()->user()->role == 1) {

                return redirect()->route('dashboardprovider.home'); 
            }else if(auth()->user()->role == 0){
                return redirect()->route('dashboardcompany.home'); 

            }


        } else {
            return redirect()->route('login')->with('error','Email-address and Password are wrong');
        }
    }
}
