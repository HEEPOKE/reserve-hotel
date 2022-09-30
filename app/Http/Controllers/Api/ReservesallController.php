<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserve;
use App\Models\Rooms;
use App\Models\Customers;
use App\Models\Checkin_checkout;
use App\Models\Identification_card_customers;



class ReservesallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reserve = Reserve::all();

        // $reserves = Reserve::orderBy('reserves.id', 'asc')
        //     ->join('customers', 'customers.id', '=', 'reserves.customer_id')
        //     ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
        //     ->where('reserves.company_id', auth()->user()->company_id);

        // $checkin_checkouts = Checkin_checkout::orderBy('id', 'asc');

        return response()->json($reserve);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $customers = new Customers;
        $customers->first_name = $request->first_name;
        $customers->last_name = $request->last_name;
        $customers->tel = $request->tel;
        $customers->email  = $request->email ;

        $customers->save();

        $reserve_quantity = $request->reserve_quantity;
        $payment_status = $request->payment_status;

        if ($reserve_quantity == '1') {
        $findid2 = Customers::orderBy('id', 'desc')->first();
        $customer_id  = $findid2->id;

        $reserve = new Reserve;
        $reserve -> customer_id = $customer_id;
        $reserve -> company_id = $request->company_id;
        $reserve -> type_room = $request->type_room;
        $reserve -> room_id = $request->room_id;
        $reserve -> room_name  = $request->room_name;
        $reserve -> guest_adult  = $request->guest_adult;
        $reserve -> guest_child  = $request->guest_child;
        $reserve -> reserve_quantity  = $reserve_quantity;
        $reserve -> start_in_room  = $request->start_in_room;
        $reserve -> end_in_room  = $request->end_in_room;
        $reserve -> payment_status  = $payment_status;
        $reserve -> payment_slip  = $request->payment_slip;
        $reserve -> total_price  = $request->total_price;


        $reserve->save();

        if ($payment_status == '0') {
        $findid = Reserve::orderBy('id', 'desc')->first();
        $reserve_id  = $findid->id;

        $checkin_checkouts = new Checkin_checkout;
        $checkin_checkouts->reserve_id = $reserve_id;
        $checkin_checkouts->stay_status = $request->stay_status;
        $checkin_checkouts->walk_in_customers = $request->walk_in_customers;

        $checkin_checkouts->save();

        $Identification_card_customers = new Identification_card_customers();
        $Identification_card_customers->reserve_id = $reserve_id;

        $Identification_card_customers->save();

        }

        } elseif ($reserve_quantity > '1') {

        for ($i = 0; $i < 1; $i++) {

            $findid3 = Customers::orderBy('id', 'desc')->first();
            $customer_id  = $findid3->id;

            $reserve = new Reserve;
            $reserve -> customer_id = $customer_id;
            $reserve -> company_id = $request->company_id;
            $reserve -> type_room = $request->type_room;
            $reserve -> room_id = $request->room_id;
            $reserve -> room_name  = $request->room_name;
            $reserve -> guest_adult  = $request->guest_adult;
            $reserve -> guest_child  = $request->guest_child;
            $reserve -> reserve_quantity  = $reserve_quantity;
            $reserve -> start_in_room  = $request->start_in_room;
            $reserve -> end_in_room  = $request->end_in_room;
            $reserve -> payment_status  = $payment_status;
            $reserve -> payment_slip  = $request->payment_slip;
            $reserve -> total_price  = $request->total_price;


            $reserve->save();

            if ($payment_status == '0') {
            $findid = Reserve::orderBy('id', 'desc')->first();
            $reserve_id  = $findid->id;

            $checkin_checkouts = new Checkin_checkout;
            $checkin_checkouts->reserve_id = $reserve_id;
            $checkin_checkouts->stay_status = $request->stay_status;
            $checkin_checkouts->walk_in_customers = $request->walk_in_customers;

            $checkin_checkouts->save();

            $Identification_card_customers = new Identification_card_customers();
            $Identification_card_customers->reserve_id = $reserve_id;

            $Identification_card_customers->save();
            }
        }

        }

        for ($i = 1; $i < $reserve_quantity; $i++) {

            $findid2 = Customers::orderBy('id', 'desc')->first();
            $customer_id  = $findid2->id;

            $reserve = new Reserve;
            $reserve -> customer_id = $customer_id;
            $reserve -> company_id = $request->company_id;
            $reserve -> type_room = $request->type_room;
            // $reserve -> room_id = $request->room_id;
            // $reserve -> room_name  = $request->room_name;
            // $reserve -> guest_adult  = $request->guest_adult;
            // $reserve -> guest_child  = $request->guest_child;
            // $reserve -> reserve_quantity  = $reserve_quantity;
            $reserve -> start_in_room  = $request->start_in_room;
            $reserve -> end_in_room  = $request->end_in_room;
            $reserve -> payment_status  = $payment_status;
            $reserve -> payment_slip  = $request->payment_slip;
            $reserve -> total_price  = $request->total_price;


            $reserve->save();

            if ($payment_status == '0') {
            $findid = Reserve::orderBy('id', 'desc')->first();
            $reserve_id  = $findid->id;

            $checkin_checkouts = new Checkin_checkout;
            $checkin_checkouts->reserve_id = $reserve_id;
            $checkin_checkouts->stay_status = $request->stay_status;
            $checkin_checkouts->walk_in_customers = $request->walk_in_customers;

            $checkin_checkouts->save();

            $Identification_card_customers = new Identification_card_customers();
            $Identification_card_customers->reserve_id = $reserve_id;

            $Identification_card_customers->save();
            }
        }

        if($reserve->save())
        {
            return ['success'=>$reserve];
        }
        else
        {
            return ['success'=>'operation failed'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //


        return $id?Reserve::find($id):Reserve::all();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $reserve=Reserve::find($id);
        $reserve -> customer_id = $request->customer_id;
        $reserve -> company_id = $request->company_id;
        $reserve -> type_room = $request->type_room;
        $reserve -> room_id = $request->room_id;
        $reserve -> room_name = $request->room_name;
        $reserve -> guest_adult = $request->guest_adult;
        $reserve -> guest_child = $request->guest_child;
        $reserve -> reserve_quantity = $request->reserve_quantity;
        $reserve -> start_in_room = $request->start_in_room;
        $reserve -> end_in_room = $request->end_in_room;
        $reserve -> payment_status = $request->payment_status;
        $reserve -> payment_slip = $request->payment_slip;
        $reserve -> total_price = $request->total_price;

        $reserve->save();

        $findid = Reserve::orderBy('id', 'desc')->first();
        $reserve_id  = $findid->id;

        $checkin_checkouts=Checkin_checkout::find($id);
        $checkin_checkouts -> $reserve_id;
        $checkin_checkouts -> stay_status = $request->stay_status;
        $checkin_checkouts -> walk_in_customers = $request->walk_in_customers;

        $checkin_checkouts->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $reserve=Reserve::find($id);
        $reserve->delete();
    }
}
