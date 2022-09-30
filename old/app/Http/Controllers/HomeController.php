<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.login');
    }

    public function home()
    {
        return view('home');
    }

    public function license_status()
    {
        $data['users'] = User::orderBy('users.id','asc')
        ->join('companies', 'companies.id', '=', 'users.company_id')
        ->paginate()
       ->where('users.role', 0);
        return view('companies.license_status', $data);
    }

    public function detailprovider() {
        $data['users'] = User::orderBy('id','asc')->paginate()->where('role','0');
        return view('companies.detailprovider', $data);
    }

    public function update(Request $request, $id) {

        $users=User::find($id);
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->save();
        return view('companies.detailprovider')->with('success', 'Company has been updated successfully');
    }


    public function detailcompany() {
        // $data['companies'] = Company::orderBy('id','asc')->paginate(5);
        return view('companies.detailcompany');


    /////////////// Dashboard ////////////////////////

    public function dashboardprovider() {

        return view('companies.dashboardprovider');
    }

    public function dashboardcompany() {

        return view('companies.dashboardcompany');
    }
    ///////////////////////////////////////////////////

    public function paymentprovider() {

        return view('companies.paymentprovider');
    }

}
}
