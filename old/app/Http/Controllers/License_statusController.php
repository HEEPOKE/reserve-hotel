<?php
namespace App\Http\Controllers;
use App\Models\Users;
use App\Models\User;
use App\Models\companies;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;

class License_statusController extends Controller
{
    //

    
    public function insert(Request $request) {
        $companies = new companies();
        $companies->company_name = $request->input('company_name');
        $companies->tel = $request->input('tel');
        $companies->email = $request->input('email');
        $companies->address = $request->input('address');
        $companies->location = $request->input('location');
        $companies->license_status = $request->input('license_status');
        $companies->license_expire = $request->input('license_expire');

        $companies->save();
        return redirect('/license_status')->with('status','Inserted Successfully');
    }

    public function update(Request $request, $id) {
        
        $users=User::find($id);
        $users->company_id = $request->input('company_id');


        $users->save();
        return redirect('/license_status')->with('status', 'Company has been updated successfully'); 
    } 
   

}
