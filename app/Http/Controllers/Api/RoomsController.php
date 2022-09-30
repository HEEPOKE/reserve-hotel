<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rooms;
use Illuminate\Support\Facades\DB;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    // {
    //     //
    //     $rooms = Rooms::all();
    //     // echo json_encode( $rooms, JSON_UNESCAPED_UNICODE );
    //     return response()->json($rooms);
    //     // return response()->json([1, 2, 3, 4, 5]);
    // }

    {
        $room = DB::table('rooms')
            ->join('companies', 'companies.id', '=', 'rooms.company_id')
            ->select(
                'rooms.id',
                'rooms.company_id',
                'rooms.room_name',
                'rooms.rooms_image',
                'rooms.room_detail',
                'rooms.room_facilities',
                'rooms.room_capacity',
                'rooms.room_quantity',
                'rooms.room_type',
                'rooms.price',
                'rooms.other',
                'rooms.other_quantity',
                'rooms.other_price',
                'companies.company_name',
                'companies.tel',
                'companies.email',
                'companies.address',
                'companies.location'
            )
            ->orderBy('id', 'ASC')
            ->get();

        $count = count($room);

        for ($i = 0; $i <= $count; $i++) {

            if ($i != $count) {

                $room_id = $room[$i]->id ?? 'id';
                $company_id = $room[$i]->company_id ?? 'company_id';
                $room_name = $room[$i]->room_name ?? 'room_name';
                $rooms_image = $room[$i]->rooms_image ?? 'rooms_image';
                $images = explode(",", $rooms_image);
                $limit = count($images);
                $result = "";

                for ($q = 0; $q < $limit; $q++) {
                    if ($q + 1 == $limit) {
                        $result .= "http://127.0.0.1:8000" . $images[$q];
                    } else {
                        $result .= "http://127.0.0.1:8000" . $images[$q] . ",";
                    }
                }

                $array_image = explode(",", $result);

                $room_detail = $room[$i]->room_detail ?? 'room_detail';
                $detail = explode(",", $room_detail);

                $room_facilities = $room[$i]->room_facilities ?? 'room_facilities';
                $facilities = explode(",", $room_facilities);

                $room_capacity = $room[$i]->room_capacity ?? 'room_capacity';
                $room_quantity = $room[$i]->room_quantity ?? 'room_quantity ';
                $room_type = $room[$i]->room_type ?? 'room_type';
                $price = $room[$i]->price ?? 'price';

                if($other = 'other'){
                    $other = $room[$i]->other ?? NULL;
                    $otherarray = explode(",", $other);
                }else{
                    $other = $room[$i]->other ?? 'other';
                    $otherarray = explode(",", $other);
                }

                if($other_quantity = 'other_quantity'){
                    $other_quantity = $room[$i]->other_quantity ?? NULL;
                    $other_quantityarray = explode(",", $other_quantity);
                }else{
                    $other_quantity = $room[$i]->other_quantity ?? 'other_quantity';
                    $other_quantityarray = explode(",", $other_quantity);
                }

                if($other_price = 'other_price'){
                    $other_price = $room[$i]->other_price ?? NULL;
                }else{
                    $other_price = $room[$i]->other_price ?? 'other_price';
                }

                // $other = $room[$i]->other ?? 'other';
                // $otherarray = explode(",", $other);

                // $other_quantity = $room[$i]->other_quantity ?? 'other_quantity';
                // $other_quantityarray = explode(",", $other_quantity);

                // $other_price = $room[$i]->other_price ?? 'other_price';
                $company_name = $room[$i]->company_name ?? 'company_name';
                $tel = $room[$i]->tel ?? 'tel';
                $email = $room[$i]->email ?? 'email';
                $address = $room[$i]->address ?? 'address';
                $location = $room[$i]->location ?? 'location';

                $data[$i] = array(
                    "id" => "$room_id",
                    "company_id" => "$company_id",
                    "room_name" => "$room_name",
                    "rooms_image" => $array_image,
                    "room_detail" => $detail,
                    "room_facilities" => $facilities,
                    "room_capacity" => "$room_capacity",
                    "room_quantity" => "$room_quantity",
                    "room_type" => "$room_type",
                    "price" => "$price",
                    "other" => $otherarray,
                    "other_quantity" => $other_quantityarray,
                    "other_price" => "$other_price",
                    "company_name" => "$company_name",
                    "tel" => "$tel",
                    "email" => "$email",
                    "address" => "$address",
                    "location" => "$location",
                );
            }
        }
        return $json = json_encode($data, JSON_UNESCAPED_UNICODE);
        // return response()->json($json);
        //  echo json_encode( $data, JSON_UNESCAPED_UNICODE );
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
        // $rooms = Rooms::all();
        // return response()->json($id);

        $room = DB::table('rooms')
            ->join('companies', 'companies.id', '=', 'rooms.company_id')
            ->select(
                'rooms.id',
                'rooms.room_name',
                'rooms.rooms_image',
                'rooms.room_detail',
                'rooms.room_facilities',
                'rooms.room_capacity',
                'rooms.room_quantity',
                'rooms.room_type',
                'rooms.price',
                'rooms.other',
                'rooms.other_quantity',
                'rooms.other_price',
                'companies.company_name',
                'companies.tel',
                'companies.email',
                'companies.address',
                'companies.location'
            )
            ->orderBy('id', 'ASC')
            ->where('rooms' . '.' . 'id', '=', $id)
            ->first();

        $room_id = $room->id ?? 'id';
        $room_name = $room->room_name ?? 'room_name';
        $rooms_image = $room->rooms_image ?? 'rooms_image';
        $images = explode(",", $rooms_image);
        $limit = count($images);
        $result = "";

        for ($q = 0; $q < $limit; $q++) {
            if ($q + 1 == $limit) {
                $result .= "http://127.0.0.1:8000" . $images[$q];
            } else {
                $result .= "http://127.0.0.1:8000" . $images[$q] . ",";
            }
        }

        $array_image = explode(",", $result);

        $room_detail = $room->room_detail ?? 'room_detail';
        $detail = explode(",", $room_detail);

        $room_facilities = $room->room_facilities ?? 'room_facilities';
        $facilities = explode(",", $room_facilities);

        $room_capacity = $room->room_capacity ?? 'room_capacity';
        $room_quantity = $room->room_quantity ?? 'room_quantity ';
        $room_type = $room->room_type ?? 'room_type';
        $price = $room->price ?? 'price';

        if($other = 'other'){
            $other = $room->other ?? NULL;
            $otherarray = explode(",", $other);
        }else{
            $other = $room->other ?? 'other';
            $otherarray = explode(",", $other);
        }

        if($other_quantity = 'other_quantity'){
            $other_quantity = $room->other_quantity ?? NULL;
            $other_quantityarray = explode(",", $other_quantity);
        }else{
            $other_quantity = $room->other_quantity ?? 'other_quantity';
            $other_quantityarray = explode(",", $other_quantity);
        }

        if($other_price = 'other_price'){
            $other_price = $room->other_price ?? NULL;
        }else{
            $other_price = $room->other_price ?? 'other_price';
        }

        // $other = $room->other ?? 'other';
        // $otherarray = explode(",", $other);

        // $other_quantity = $room->other_quantity ?? 'other_quantity';
        // $other_quantityarray = explode(",", $other_quantity);

        // $other_price = $room->other_price ?? 'other_price';

        $company_name = $room->company_name ?? 'company_name';
        $tel = $room->tel ?? 'tel';
        $email = $room->email ?? 'email';
        $address = $room->address ?? 'address';
        $location = $room->location ?? 'location';

        $data = array(
            "id" => "$room_id",
            "room_name" => "$room_name",
            "rooms_image" => $array_image,
            "rooms_detail" => $detail,
            "rooms_facilities" => $facilities,
            "room_capacity" => "$room_capacity",
            "room_quantity" => "$room_quantity",
            "room_type" => "$room_type",
            "price" => "$price",
            "other" => $otherarray,
            "other_quantity" => $other_quantityarray,
            "other_price" => "$other_price",
            "company_name" => "$company_name",
            "tel" => "$tel",
            "email" => "$email",
            "address" => "$address",
            "location" => "$location",
        );

        // return $id ? Rooms::find($id) : Rooms::all();
        return response()->json($data);
        //    echo json_encode( $rooms, JSON_UNESCAPED_UNICODE );
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
