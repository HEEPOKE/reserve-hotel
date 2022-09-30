<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserve;

class ReserveController extends Controller
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
        $reserve = new Reserve;
        $reserve -> customer_id = $request->customer_id;
        $reserve -> company_id = $request->company_id;
        $reserve -> room_id = $request->room_id;
        $reserve -> room_name  = $request->room_name;
        $reserve -> guest_adult  = $request->guest_adult;
        $reserve -> guest_child  = $request->guest_child;
        $reserve -> reserve_quantity  = $request->reserve_quantity;
        $reserve -> start_in_room  = $request->start_in_room;
        $reserve -> end_in_room  = $request->end_in_room;
        $reserve -> payment_status  = $request->payment_status;
        $reserve -> payment_slip  = $request->payment_slip;
        $reserve -> total_price  = $request->total_price;

        $reserve->save();

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
        //
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
    }
}
