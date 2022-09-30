<?php

namespace App\Http\Controllers;


use App\Models\Customers;
use App\Models\User;
use App\Models\Rooms;
use App\Models\Reserve;
use Illuminate\Http\Request;

class ManageusersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add_customer(Request $request) {
        $customers = new Customers();
        $customers->first_name = $request->input('first_name');
        $customers->last_name = $request->input('last_name');
        $customers->tel = $request->input('tel');
        $customers->email = $request->input('email');
        $customers->save();
        return redirect('/manageuser')->with('addsuccess', 'เพิ่มข้อมูลลูกค้าสำเร็จ');
    }

    public function update_customer(Request $request, $id) {

        $customers=Customers::find($id);
        $customers->first_name = $request->input('first_name');
        $customers->last_name = $request->input('last_name');
        $customers->tel = $request->input('tel');
        $customers->email = $request->input('email');
        $customers->save();
        return redirect('/manageuser')->with('updatesuccess', 'เเก้ไขข้อมูลลูกค้าสำเร็จ');
    }

    public function delete_customer($id) {
        $customers=Customers::find($id);
        $customers->delete();
        return redirect('/manageuser')->with('delete', 'ลบข้อมูลลูกค้าสำเร็จ');
    }

    public function searchtype($id) {

        return redirect('/manageuser');
    }

    public function search_manageuser(Request $request)
    {
        $formDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $query = Reserve::orderBy('reserves.id', 'desc')
        ->join('customers', 'customers.id', '=', 'reserves.customer_id')
        ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'customers.id')
        ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
        ->where('checkin_checkouts.walk_in_customers', '0')
        ->where('reserves.company_id', auth()->user()->company_id)
         ->where('start_in_room', '>=', $formDate)
         ->where('start_in_room', '<=', $toDate)
         ->paginate();
        //  dd($query);

        $customers = Reserve::orderBy('reserves.id', 'desc')
        ->join('customers', 'customers.id', '=', 'reserves.customer_id')
        ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'customers.id')
        ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
        ->where('checkin_checkouts.walk_in_customers', '0')
        ->where('reserves.company_id', auth()->user()->company_id)
        ->paginate(5);



        $customers4 = Reserve::orderBy('reserves.id', 'desc')
        ->join('customers', 'customers.id', '=', 'reserves.customer_id')
        ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'customers.id')
        ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
        ->where('checkin_checkouts.walk_in_customers', '1')
        ->where('reserves.company_id', auth()->user()->company_id)
        ->paginate(5);

        $customers2 = Customers::selectRaw('rooms.room_type as type_report')
        ->join('checkin_checkouts', 'checkin_checkouts.reserve_id', '=', 'customers.id')
        ->join('reserves', 'reserves.customer_id', '=', 'customers.id')
        ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
        ->where('rooms.company_id', auth()->user()->company_id)
        ->groupBy('type_report')
        ->orderBy('type_report', 'ASC')
        ->paginate();

        $customers3 = Customers::selectRaw('checkin_checkouts.stay_status as check_report')
        ->join('checkin_checkouts', 'checkin_checkouts.reserve_id', '=', 'customers.id')
        ->join('reserves', 'reserves.customer_id', '=', 'customers.id')
        ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
        ->where('rooms.company_id', auth()->user()->company_id)
        ->groupBy('check_report')
        ->orderBy('check_report', 'ASC')
        ->paginate();

        return view('pages.company_manageuser', compact('customers', 'customers2', 'customers3', 'customers4','query'));
    }
}
