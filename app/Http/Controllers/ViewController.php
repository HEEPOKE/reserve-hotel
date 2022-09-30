<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Companies;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class ViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function insert(Request $request)
    {
        $users = new User();
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->password = Hash::make($request->input('password'));
        $users->company_id = $request->input('company_id');
        $companies = new Companies();
        $companies->company_name = $request->input('company_name');
        $companies->tel = $request->input('tel');
        $companies->email = $request->input('email');
        // $companies->address = $request->input('address');
        // $companies->location = $request->input('location');
        $companies->license_status = $request->input('license_status');
        $companies->license_expire = $request->input('license_expire');
        $companies->renew_contract = $request->input('renew_contract');
        $users->save();
        $companies->save();
        return redirect('/detailprovider')->with('status', 'เพิ่มข้อมูลสำเร็จ');
    }

    public function insertemployee(Request $request)
    {
        $users = new User();
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->password = Hash::make($request->input('password'));
        $users->company_id = $request->input('company_id');
        $users->role = $request->input('role');


        $companies = new Companies();
        $companies->company_name = $request->input('company_name');
        $companies->tel = $request->input('tel');
        $companies->email = $request->input('email');
        // $companies->address = $request->input('address');
        // $companies->location = $request->input('location');
        $companies->license_status = $request->input('license_status');
        $companies->license_expire = $request->input('license_expire');
        $companies->renew_contract = $request->input('renew_contract');
        $users->save();
        $companies->save();
        return redirect('/detailcompany')->with('employeeinsertesuccess', 'เพิ่มข้อมูลสำเร็จ');
    }

    public function update(Request $request, Companies $companies, $id)
    {

        $companies = Companies::find($id);
        // $companies->license_expire = $request->input('license_expire');
        // $companies->license_status = $request->input('license_status');
        $companies->renew_contract = $request->input('renew_contract');

        // $users->save();
        $companies->save();
        return redirect('/detailprovider')->with('success', 'เเก้ไขข้อมูลสถานประกอบการสำเร็จ');
    }

    public function insert2(Request $request)
    {
        $companies = new companies();
        $companies->company_name = $request->input('company_name');
        $companies->tel = $request->input('tel');
        $companies->email = $request->input('email');
        $companies->address = $request->input('address');
        $companies->location = $request->input('location');
        $companies->license_status = $request->input('license_status');
        $companies->license_expire = $request->input('license_expire');
        $companies->renew_contract = $request->input('renew_contract');

        $companies->save();
        return redirect('/statusprovider')->with('status', 'เพิ่มข้อมูลสำเร็จ');
    }

    public function update2(Request $request, $id)
    {

        $companies = companies::find($id);
        $companies->company_name = $request->input('company_name');
        $companies->tel = $request->input('tel');
        $companies->address = $request->input('address');
        $companies->location = $request->input('location');
        $companies->license_status = $request->input('license_status');
        $companies->license_expire = $request->input('license_expire');
        $companies->renew_contract = $request->input('renew_contract');

        $companies->save();
        return redirect('/statusprovider')->with('success', 'เเก้ไขข้อมูลสถานประกอบการสำเร็จ');
    }

    public function update4(Request $request, Companies $companies, $id)
    {
        $request->validate([
            'company_logo' => 'nullable',
        ]);

        date_default_timezone_set("Asia/Bangkok");

        $companies = Companies::find($id);

        $selectimg = $companies->company_logo;

        $checkfiles = $request->hasfile('company_logo');

        if ($checkfiles == true) {
            $files = $request->file('company_logo');

            if ($selectimg == null) {
                $fileName = '/logo_image/' . rand(1, 10000) . date("dmYHis") . '.' . $files->extension();
                $files->move('logo_image', $fileName);

                $companies->company_logo = $fileName;
            } else {
                if (File::exists(public_path($selectimg))) {
                    File::delete(public_path($selectimg));
                }

                $fileName = '/logo_image/' . rand(1, 10000) . date("dmYHis") . '.' . $files->extension();
                $files->move('logo_image', $fileName);

                $companies->company_logo = $fileName;
            }
        } else {
            $companies->company_logo = $selectimg;
        }

        $companies->company_name = $request->input('company_name');
        $companies->tel = $request->input('tel');
        $companies->email = $request->input('email');
        $companies->address = $request->input('address');
        $companies->location = $request->input('location');
        // $companies->license_expire = $request->input('license_expire');
        // $companies->license_status = $request->input('license_status');
        $companies->renew_contract = $request->input('renew_contract');

        $companies->save();
        return redirect('/detailcompany')->with('success', 'เเก้ไขข้อมูลสถานประกอบการสำเร็จ');
    }

    public function update5(Request $request, $id)
    {

        date_default_timezone_set("Asia/Bangkok");

        $users = User::find($id);
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->save();

        $companies = Companies::find($id);
        $companies->tel = $request->input('tel');
        $companies->email = $request->input('email');
        $companies->save();
        return redirect('/detailemployee')->with('success', 'เเก้ไขข้อมูลสถานประกอบการสำเร็จ');
    }

    public function banin(Request $request, $id)
    {

            $users = User::orderBy('company_id', 'asc')
            ->where('company_id', $id)
            ->where('role', '0')
            ->update(['role' => 5]);

            $users2 = User::orderBy('company_id', 'asc')
            ->where('company_id', $id)
            ->where('role', '3')
            ->update(['role' => 6]);

        return redirect('/detailprovider')->with('bansuccess', 'เเก้ไขข้อมูลสถานประกอบการสำเร็จ');
    }

    public function banout(Request $request, $id)
    {

        $users = User::where('company_id', $id)
        ->where('role', '5')
        ->update(['role' => 0]);

        $users2 = User::where('company_id', $id)
        ->where('role', '6')
        ->update(['role' => 3]);

        return redirect('/listban')->with('banout', 'เเก้ไขข้อมูลสถานประกอบการสำเร็จ');
    }

    public function updatestatus(Request $request, $id)
    {

        $companies = Companies::find($id);
        $companies->license_expire = $request->input('license_expire');
        $companies->license_status = $request->input('license_status');
        $companies->renew_contract = $request->input('renew_contract');

        $companies->save();
        return redirect('/detailprovider')->with('success', 'เเก้ไขข้อมูลสถานประกอบการสำเร็จ');
    }

    public function updatestatusout(Request $request, $id)
    {

        $users = User::where('company_id', $id)
        ->where('role', '0')
        ->update(['role' => 7]);

        return redirect('/detailprovider')->with('success', 'เเก้ไขข้อมูลสถานประกอบการสำเร็จ');
    }
}
