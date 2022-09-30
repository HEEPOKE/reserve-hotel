<?php

namespace App\Http\Controllers;
use App\Models\Users;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;

class DetailproviderController extends Controller
{
    //
    public function insert(Request $request) {
        $users = new User();
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->password = Hash::make($request->input('password'));
        $users->save();
        return redirect('/detailprovider')->with('status','Inserted Successfully');
    }

    public function update(Request $request, $id) {
        
        $users=User::find($id);
        $users->name = $request->input('name');
        $users->email = $request->input('email');

        $users->save();
        return redirect('/detailprovider')->with('success', 'Company has been updated successfully'); 
    } 

    public function delete($id){
        $users=User::find($id);
        $users->delete();
        return redirect('/detailprovider');
    }
}
