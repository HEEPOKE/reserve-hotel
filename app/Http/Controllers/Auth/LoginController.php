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
    protected $redirectTo = RouteServiceProvider::HOME;

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
                return redirect()->route('dashboardprovider');
                /// ผู้ให้บริการ
                // return view('pages.provider_dashboardprovider');
            }else if(auth()->user()->role == 0){
                return redirect()->route('dashboardcompany');
                /// ผู้ใช้งาน
                // return view('pages.company_dashboardcompany');
            }else if(auth()->user()->role == 2){
                return redirect()->route('dashboardprovider');
                /// แอดมินฝั่งผู้ให้บริการ
                // return view('pages.provider_dashboardprovider');
            }else if(auth()->user()->role == 3){
                return redirect()->route('dashboardcompany');
                /// แอดมินฝั่งผู้ใช้งาน
                // return view('pages.company_dashboardcompany');
            }else if(auth()->user()->role == 4){
                /// ลูกค้า
                return redirect()->route('dashboardcustomers');
                // return view('pages.customers_dashboardcustomers');
            }else if(auth()->user()->role == 5){
                /// ผู้ถูกแบน
                // return redirect()->route('dashboardban');
                return view('pages.company_dashboardban');
            }else if(auth()->user()->role == 6){
                /// พนักงานที่ถูกแบน
                // return redirect()->route('login');
                return view('pages.company_dashboardban');
            }else if(auth()->user()->role == 7){
                /// หมดอายุ
                // return redirect()->route('login');
                return view('pages.company_dashboardexpire');
            }



        } else {
            return redirect()->route('login')->with('error','Email-address and Password are wrong');
        }
    }
}
