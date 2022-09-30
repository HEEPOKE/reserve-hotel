<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Alert;
use App\Models\Rooms;
use App\Models\Reserve;
use App\Models\Customers;
use Illuminate\Http\Request;
use App\Http\Middleware\role;
use App\Models\Checkin_checkout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Models\Identification_card_customers;
use JeroenNoten\LaravelAdminLte\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Banks;
use App\Models\Companies;
use App\Models\Catagories;
use Illuminate\Support\Facades\Route;
use App\Models\Provider_payment_methods;


class BookingController extends Controller
{
    public function detailbooking()
    {

        $catagories = Catagories::orderBy('id', 'ASC')
        // ->join('reserves', 'reserves.booking_id', '=', 'catagories.booking_id')
        ->where('hotel_id', auth()->user()->company_id)
            ->paginate(10);

        $catagoriesall = Catagories::orderBy('id', 'ASC')

        // ->where('reserves.company_id', auth()->user()->company_id)
            ->paginate();

        return view('pages.company_detailbooking', compact('catagoriesall', 'catagories'));
    }

    public function insert(Request $request) {
        $catagories = new Catagories();
        $catagories->cat_name = $request->input('cat_name');
        $catagories->booking_id = $request->input('booking_id');
        $catagories->hotel_id = $request->input('hotel_id');
        $catagories->save();

        return redirect('/detailbooking')->with('status','เเก้ไขข้อมูลสำเร็จ');
    }


}
