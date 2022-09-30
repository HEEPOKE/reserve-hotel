<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Provider_payment_methods;
use App\Models\Banks;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function insert(Request $request) {
        $Provider_payment_methods = new Provider_payment_methods();
        $Provider_payment_methods->company_id = $request->input('company_id');
        // $Provider_payment_methods->company_name = $request->input('company_name');
        $Provider_payment_methods->payment_type = $request->input('payment_type');
        // $Provider_payment_methods->bank_id = $request->input('bank_id');
        $Provider_payment_methods->bank_account_no = $request->input('bank_account_no');
        $Provider_payment_methods->save();

        $Banks = new Banks();
        $Banks->bank_name = $request->input('bank_name');
        $Banks->save();
        return redirect('/paymentprovider')->with('status','เเก้ไขข้อมูลสำเร็จ');
    }

    public function update3(Request $request, $id) {

        $Provider_payment_methods=Provider_payment_methods::find($id);
        $Provider_payment_methods->payment_type = $request->input('payment_type');
        $Provider_payment_methods->bank_account_no = $request->input('bank_account_no');

        $Banks=Banks::find($id);
        $Banks->bank_name = $request->input('bank_name');

        $Provider_payment_methods->save();
        $Banks->save();
        return redirect('/paymentprovider')->with('success', 'การแก้ไขสำเร็จ');
    }

    public function insert2(Request $request) {
        $Provider_payment_methods = new Provider_payment_methods();
        $Provider_payment_methods->company_id = $request->input('company_id');
        $Provider_payment_methods->payment_type = $request->input('payment_type');
        // $Provider_payment_methods->bank_id = $request->input('bank_id');
        $Provider_payment_methods->bank_account_no = $request->input('bank_account_no');
        $Provider_payment_methods->save();

        $Banks = new Banks();
        $Banks->bank_name = $request->input('bank_name');
        $Banks->save();
        return redirect('/paymentcompany')->with('status','เพิ่มข้อมูลสำเร็จ');
    }

    public function update4(Request $request, $id) {

        $Provider_payment_methods=Provider_payment_methods::find($id);
        $Provider_payment_methods->payment_type = $request->input('payment_type');
        $Provider_payment_methods->bank_account_no = $request->input('bank_account_no');

        $Banks=Banks::find($id);
        $Banks->bank_name = $request->input('bank_name');

        $Provider_payment_methods->save();
        $Banks->save();
        return redirect('/paymentcompany')->with('success', 'การแก้ไขสำเร็จ');
    }
}
