<?php

namespace App\Http\Controllers;

// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;

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
use App\Models\Catagories;
use JeroenNoten\LaravelAdminLte\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Http\Controllers\QrCodeController;

require ('FormatController.php');

class ReserveController extends Controller
{
    // private $data = [];

    public function __construct()
    {
        $this->middleware('auth');
        // $this->data = $data;
    }

    public function index(Request $request)
    {

        $currentURL = $request->segment(2);
        // dd($currentURL);
        $reserves = Reserve::orderBy('reserves.id', 'desc')
            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
            ->join('identification_card_customers', 'identification_card_customers.reserve_id', '=', 'reserves.id')
            ->where('reserves.company_id', auth()->user()->company_id)

            ->paginate(10);

        $customers = Customers::orderBy('id', 'ASC')
            ->paginate();

        $rooms = Rooms::orderBy('id', 'ASC')
            ->where('company_id', Auth::user()->company_id)
            ->paginate();

        $roomstype = Rooms::selectRaw('count(*) as count_room, rooms.room_type as room_type')
            ->where('company_id', Auth::user()->company_id)
            ->groupBy('room_type')
            ->orderBy('room_type', 'ASC')
            ->paginate();


        $reservescount = Reserve::selectRaw('reserves.customer_id as count_customer')
            ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
            ->groupBy('count_customer')
            ->orderBy('count_customer', 'ASC')
            ->paginate();

        $catagories = Catagories::orderBy('id', 'ASC')
            ->paginate();

        $catagoriesall = Catagories::orderBy('id', 'ASC')
            ->paginate();

        return view('pages.company_detailreserve', compact('reserves', 'customers', 'rooms', 'reservescount', 'roomstype', 'catagories', 'catagoriesall', 'currentURL'));
    }

    public function insert(Request $request)
    {
        $request->validate([
            'payment_status' => 'required',
            'company_id' => 'required',
            'customer_id' => 'nullable',
            'stay_status' => 'required',
            'walk_in_customers' => 'required',
            'type_room' => 'required',
            'room_id' => 'required',
            'guest_adult' => 'required',
            'guest_child' => 'required',
            'reserve_quantity' => 'required',
            'start_in_room' => 'required',
            'end_in_room' => 'required',
        ]);

        $reserve_quantity  = $request->input('reserve_quantity');
        $payment_status = $request->input('payment_status');

        $room_id = $request->input('room_id');
        $rooms = Rooms::find($room_id);
        $room_name  = $rooms->room_name;
        $price  = $rooms->price;

        $customer_id = $request->input('customer_id');
        $company_id = $request->input('company_id');
        $stay_status = $request->input('stay_status');
        $type_room = $request->input('type_room');
        $guest_adult = $request->input('guest_adult');
        $guest_child = $request->input('guest_child');
        $start_in_room = $request->input('start_in_room');
        $end_in_room = $request->input('end_in_room');

        $checkinDate = explode('-', $start_in_room);
        $totalCheckin = $checkinDate[2] . ' ' . formatMonth($checkinDate[1]) . ' ' . 'พ.ศ.' . $checkinDate[0] + 543;

        $checkoutDate = explode('-', $end_in_room);
        $totalCheckout = $checkoutDate[2] . ' ' . formatMonth($checkoutDate[1]) . ' ' . 'พ.ศ.' . $checkoutDate[0] + 543;

        if ($customer_id != NUll || $customer_id != '') {
            $customersdata = Customers::find($customer_id);

            $customer_name = $customersdata->first_name;
            $customer_lastname = $customersdata->last_name;
        }

        if ($reserve_quantity == '1') {

            $Reserve = new Reserve();
            $Reserve->customer_id = $customer_id;
            $Reserve->company_id = $company_id;
            $Reserve->type_room = $type_room;
            $Reserve->room_id = $room_id;
            $Reserve->room_name = $room_name;
            $Reserve->guest_adult = $guest_adult;
            $Reserve->guest_child = $guest_child;
            $Reserve->reserve_quantity = $reserve_quantity;
            $Reserve->start_in_room = $start_in_room;
            $Reserve->end_in_room = $end_in_room;
            $Reserve->payment_status = $payment_status;

            $Reserve->save();

            if ($payment_status == '0') {
                $findid = Reserve::orderBy('id', 'desc')->first();
                $reserve_id  = $findid->id;

                $Checkin_checkout = new Checkin_checkout();
                $Checkin_checkout->reserve_id = $reserve_id;
                $Checkin_checkout->stay_status = $stay_status;
                $Checkin_checkout->walk_in_customers = $request->input('walk_in_customers');

                $Identification_card_customers = new Identification_card_customers();
                $Identification_card_customers->reserve_id = $reserve_id;

                $Checkin_checkout->save();
                $Identification_card_customers->save();
            }
        } elseif ($reserve_quantity > '1') {
            for ($i = 0; $i < 1; $i++) {

                $Reserve = new Reserve();
                $Reserve->customer_id = $customer_id;
                $Reserve->company_id = $company_id;
                $Reserve->type_room = $type_room;
                $Reserve->room_id = $room_id;
                $Reserve->room_name = $room_name;
                $Reserve->guest_adult = $guest_adult;
                $Reserve->guest_child = $guest_child;
                $Reserve->reserve_quantity = $reserve_quantity;
                $Reserve->start_in_room = $start_in_room;
                $Reserve->end_in_room = $end_in_room;
                $Reserve->payment_status = $payment_status;

                $Reserve->save();

                if ($payment_status == '0') {
                    $findid = Reserve::orderBy('id', 'desc')->first();
                    $reserve_id  = $findid->id;

                    $Checkin_checkout = new Checkin_checkout();
                    $Checkin_checkout->reserve_id = $reserve_id;
                    $Checkin_checkout->stay_status = $stay_status;
                    $Checkin_checkout->walk_in_customers = $request->input('walk_in_customers');

                    $Checkin_checkout->save();

                    $Identification_card_customers = new Identification_card_customers();
                    $Identification_card_customers->reserve_id = $reserve_id;

                    $Identification_card_customers->save();
                }
            }

            for ($i = 1; $i < $reserve_quantity; $i++) {

                $Reserve = new Reserve();
                $Reserve->customer_id = $customer_id;
                $Reserve->company_id = $company_id;
                $Reserve->type_room = $type_room;
                // $Reserve->room_id = $room_id;
                // $Reserve->room_name = $room_name;
                // $Reserve->guest_adult = $guest_adult');
                // $Reserve->guest_child = $guest_child');
                // $Reserve->reserve_quantity = $reserve_quantity');
                $Reserve->start_in_room = $start_in_room;
                $Reserve->end_in_room = $end_in_room;
                $Reserve->payment_status = $payment_status;

                $Reserve->save();

                if ($payment_status == '0') {
                    $findid = Reserve::orderBy('id', 'desc')->first();
                    $reserve_id  = $findid->id;

                    $Checkin_checkout = new Checkin_checkout();
                    $Checkin_checkout->reserve_id = $reserve_id;
                    $Checkin_checkout->stay_status = $stay_status;
                    $Checkin_checkout->walk_in_customers = $request->input('walk_in_customers');

                    $Identification_card_customers = new Identification_card_customers();
                    $Identification_card_customers->reserve_id = $reserve_id;

                    $Checkin_checkout->save();
                    $Identification_card_customers->save();
                }
            }
        }

        $mailData = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp.',
            'room_name' => $room_name,
            'room_type' => $type_room,
            'customer_name' => $customer_name . ' ' . $customer_lastname,
            'price' => $price . ' ' . 'บาท',
            'guest_adult' => $guest_adult . ' ' . 'คน',
            'guest_child' => $guest_child .  ' ' . 'คน',
            'checkin' => $totalCheckin,
            'checkout' => $totalCheckout
        ];

        Mail::to('rubymaki6476@gmail.com')->send(new SendMail($mailData));

        return redirect('/detailbooking')->with('status', 'เพิ่มข้อมูลการจองสำเร็จ');
    }

    public function update_reserves(Request $request, $id)
    {

        $request->validate([
            'room_id' => 'required',
            'guest_adult' => 'required',
            'guest_child' => 'required',
            'start_in_room' => 'required',
            'end_in_room' => 'required',
            'payment_slip' => 'nullable'
        ]);

        date_default_timezone_set("Asia/Bangkok");

        $room_id = $request->input('room_id');

        $rooms = Rooms::find($room_id);
        $room_name  = $rooms->room_name;

        $reserves = Reserve::find($id);
        $reserves->room_id = $room_id;
        $reserves->room_name = $room_name;
        $reserves->guest_adult = $request->input('guest_adult');
        $reserves->guest_child = $request->input('guest_child');
        $reserves->start_in_room = $request->input('start_in_room');
        $reserves->end_in_room = $request->input('end_in_room');

        $oldimg = $reserves->payment_slip;

        $checkslip = $request->hasfile('payment_slip');
        if ($checkslip  == true) {
            $files = $request->file('payment_slip');
            $countfiles = count($files);
            $result = "";

            for ($i = 0; $i < $countfiles; $i++) {
                $name[$i] = '/payment_images/' . rand(1, 10000) . date("dmYHis") . '.' . $files[$i]->extension();
                $files[$i]->move('payment_images', $name[$i]);

                if ($i + 1 == $countfiles) {
                    $result .= $name[$i];
                } else {
                    $result .= $name[$i] . ",";
                }
            }

            if ($oldimg == NULL && $checkslip == true) {
                $reserves->payment_slip = $result;
            } elseif ($oldimg != NULL && $checkslip == true) {
                $updateimg = $oldimg . "," . $result;
                $reserves->payment_slip = $updateimg;
            } elseif ($oldimg != NULL && $checkslip == false) {
                $reserves->payment_slip = $oldimg;
            }
        } else {
            $reserves->payment_slip = $oldimg;
        }

        $reserves->save();
        return redirect('/detailreserve')->with('success', 'เเก้ไขข้อมูลสำเร็จ');
    }

    public function delete_reserves($id)
    {
        $reserves = Reserve::find($id);
        $payment_slip = $reserves->payment_slip;

        $array_image = explode(",", $payment_slip);

        foreach ($array_image as $image) {
            if (File::exists(public_path($image))) {
                File::delete(public_path($image));
            }
        }

        $identification_card_customers = Identification_card_customers::find($id);
        $identification_card_customers->delete();

        $checkin_checkouts = Checkin_checkout::find($id);
        $checkin_checkouts->delete();
        $reserves->delete();


        return redirect('/detailreserve')->with('delete', 'ลบข้อมูลการจองสำเร็จ');
    }

    public function check_reserves(Request $request, $id)
    {
        $request->validate([
            'stay_status' => 'required',
        ]);

        $Checkin_checkouts = Checkin_checkout::find($id);
        $Checkin_checkouts->stay_status = $request->input('stay_status');

        $Checkin_checkouts->save();

        return redirect('/detailreserve')->with('successcheckin', 'เเก้ไขข้อมูลสำเร็จ');
    }

    public function payment_reserves(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required',
        ]);

        $reserves = Reserve::find($id);
        $reserves->payment_status = $request->input('payment_status');

        $reserves->save();

        return redirect('/detailreserve')->with('successpayment', 'เเก้ไขข้อมูลสำเร็จ');
    }

    public function delete_slip(Request $request, $id)
    {
        $request->validate([
            'payment_slip' => 'required',
            'index_delete' => 'required',
        ]);

        $reserve = Reserve::find($id);
        $request_images = $request->input('payment_slip');
        $indexDelete = $request->input('index_delete');
        $images_array = explode(",", $request_images);

        // ภาพที่ถูกลบ
        $select_image = array_splice($images_array, $indexDelete, 1);
        $delete_image = implode(",", $select_image);

        $limit = count($images_array);

        $result = "";

        for ($i = 0; $i < $limit; $i++) {
            if ($i + 1 == $limit) {
                $result .= $images_array[$i];
            } else {
                $result .= $images_array[$i] . ",";
            }
        }

        if (File::exists(public_path('payment_images/' . $delete_image))) {
            File::delete(public_path('payment_images/' . $delete_image));
        }

        $reserve->payment_slip = $result;

        $reserve->save();

        return redirect('/detailreserve')->with('delete', 'ลบรูปภาพสำเร็จ');
    }


    public function smart_insert(Request $request, $id)
    {

        $Identification_card_customers = Identification_card_customers::find($id);
        $Identification_card_customers->name_prefixth = $request->input('name_prefixth');
        $Identification_card_customers->name_prefixen = $request->input('name_prefixen');
        $Identification_card_customers->first_nameth = $request->input('first_nameth');
        $Identification_card_customers->first_nameen = $request->input('first_nameen');
        $Identification_card_customers->last_nameth = $request->input('last_nameth');
        $Identification_card_customers->last_nameen = $request->input('last_nameen');
        $Identification_card_customers->identity_card = $request->input('identity_card');
        $Identification_card_customers->inhabited = $request->input('inhabited');
        $Identification_card_customers->soi = $request->input('soi');
        $Identification_card_customers->tumbol = $request->input('tumbol');
        $Identification_card_customers->amphur = $request->input('amphur');
        $Identification_card_customers->street = $request->input('street');
        $Identification_card_customers->province = $request->input('province');
        $Identification_card_customers->birthdate = $request->input('birthdate');
        $Identification_card_customers->gender = $request->input('gender');
        // $Identification_card_customers->image_customer = $request->file('image_customer');

        if ($files = $request->input('image_customer')) {
            $fileName = '/card_image/' . rand(1, 10000) . date("dmYHis") . '.' . $files->extension();
            $files->move('card_image', $fileName);
        }

        $Identification_card_customers->image_customer = $fileName;

        $Identification_card_customers->save();

        return redirect('/detailreserve')->with('success', 'เเก้ไขข้อมูลสำเร็จ');
    }

    public function findselect(Request $request)
    {
        $selectroom = Rooms::select('room_type', 'room_name', 'id')
            ->where('room_type', $request->id)->take(100)
            ->get();

        $output = '<option value="">กรุณาเลือกห้อง</option>';
        foreach ($selectroom as $selectroomrow) {
            $output .= '<option   value="' . $selectroomrow->id . '">' . $selectroomrow->room_name . '</option>';
        }
        echo $output;


        // return response()->json($selectroom);
    }

    public function send_mail()
    {
    }
}
