<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rooms;
use Illuminate\Support\Facades\DB;

class CompanyroomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($company_id)
    {
        //
        $room = Rooms::orderBy('companies.id', 'ASC')
        ->join('companies', 'companies.id', '=', 'rooms.company_id')
        ->where('rooms' . '.' . 'company_id', '=', $company_id)
        ->get();

        $room2 = Rooms::
        where('rooms' . '.' . 'company_id', '=', $company_id)
        ->get();

    $count = count($room);

    for ($i = 0; $i <= $count; $i++) {

        if ($i != $count) {

            $id = $room2[$i]->id ?? 'id';
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

            if($more_detail = 'more_detail'){
                $more_detail = $room[$i]->more_detail ?? NULL;
                $more_detailarray = explode(",", $more_detail);
            }else{
                $more_detail = $room[$i]->more_detail ?? 'more_detail';
                $more_detailarray = explode(",", $more_detail);
            }

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
            $company_logo = $room[$i]->company_logo ?? 'company_logo';
            $imagelogo = explode(",", $company_logo);
            $limitlogo = count($imagelogo);
            $resultlogo = "";

            for ($q = 0; $q < $limitlogo; $q++) {
                if ($q + 1 == $limitlogo) {
                    $resultlogo .= "http://127.0.0.1:8000" . $imagelogo[$q];
                } else {
                    $resultlogo .= "http://127.0.0.1:8000" . $imagelogo[$q] . ",";
                }
            }

            $array_imagelogo = explode(",", $resultlogo);

            $company_name = $room[$i]->company_name ?? 'company_name';
            $tel = $room[$i]->tel ?? 'tel';
            $email = $room[$i]->email ?? 'email';
            $address = $room[$i]->address ?? 'address';
            $location = $room[$i]->location ?? 'location';
            $license_expire = $room[$i]->license_expire ?? 'license_expire';
            $license_status = $room[$i]->license_status ?? 'license_status';
            $renew_contract = $room[$i]->renew_contract ?? 'renew_contract';

            $data[$i] = array(
                "company_id" => "$company_id",
                "company_logo" => $array_imagelogo,
                "company_name" => "$company_name",
                "tel" => "$tel",
                "email" => "$email",
                "address" => "$address",
                "location" => "$location",
                "license_expire" => "$license_expire",
                "license_status" => "$license_status",
                "renew_contract" => "$renew_contract",
                "id" => "$id",
                "room_name" => "$room_name",
                "room_detail" => $detail,
                "room_facilities" => $facilities,
                "room_capacity" => "$room_capacity",
                "room_quantity" => "$room_quantity",
                "room_type" => "$room_type",
                "price" => "$price",
                "more_detail" => $more_detailarray,
                "rooms_image" => $array_image,
                "other" => $otherarray,
                "other_quantity" => $other_quantityarray,
                "other_price" => "$other_price",


                // "company_id" => "$company_id",
                // "id" => "$room_id",
                // // "company_name" => "$company_name",
                // "room_name" => "$room_name",
                // "rooms_image" => $array_image,
                // "room_detail" => $detail,
                // "room_facilities" => $facilities,
                // "room_capacity" => "$room_capacity",
                // "room_quantity" => "$room_quantity",
                // "room_type" => "$room_type",
                // "price" => "$price",
                // "other" => $otherarray,
                // "other_quantity" => $other_quantityarray,
                // "other_price" => "$other_price",
                // // "tel" => "$tel",
                // // "email" => "$email",
                // // "address" => "$address",
                // // "location" => "$location",
                // // "license_expire" => "$license_expire",
                // // "license_status" => "$license_status",
                // // "renew_contract" => "$renew_contract",
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
    public function show($company_id, $id)
    {
         //
         $room = Rooms::orderBy('companies.id', 'ASC')
         ->join('companies', 'companies.id', '=', 'rooms.company_id')
         ->where('rooms' . '.' . 'company_id', '=', $company_id)
         ->where('rooms' . '.' . 'id', '=', $id)
         ->get();

         $room2 = Rooms::
         where('rooms' . '.' . 'id', '=', $id)
         ->get();

     $count = count($room);

     for ($i = 0; $i <= $count; $i++) {

         if ($i != $count) {

             $id = $room2[$i]->id ?? 'id';
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

             if($more_detail = 'more_detail'){
                $more_detail = $room[$i]->more_detail ?? NULL;
                $more_detailarray = explode(",", $more_detail);
            }else{
                $more_detail = $room[$i]->more_detail ?? 'more_detail';
                $more_detailarray = explode(",", $more_detail);
            }

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
             $company_logo = $room[$i]->company_logo ?? 'company_logo';
             $imagelogo = explode(",", $company_logo);
             $limitlogo = count($imagelogo);
             $resultlogo = "";

             for ($q = 0; $q < $limitlogo; $q++) {
                 if ($q + 1 == $limitlogo) {
                     $resultlogo .= "http://127.0.0.1:8000" . $imagelogo[$q];
                 } else {
                     $resultlogo .= "http://127.0.0.1:8000" . $imagelogo[$q] . ",";
                 }
             }

             $array_imagelogo = explode(",", $resultlogo);

             $company_name = $room[$i]->company_name ?? 'company_name';
             $tel = $room[$i]->tel ?? 'tel';
             $email = $room[$i]->email ?? 'email';
             $address = $room[$i]->address ?? 'address';
             $location = $room[$i]->location ?? 'location';
             $license_expire = $room[$i]->license_expire ?? 'license_expire';
             $license_status = $room[$i]->license_status ?? 'license_status';
             $renew_contract = $room[$i]->renew_contract ?? 'renew_contract';

             $data[$i] = array(
                 "company_id" => "$company_id",
                 "company_logo" => $array_imagelogo,
                 "company_name" => "$company_name",
                 "tel" => "$tel",
                 "email" => "$email",
                 "address" => "$address",
                 "location" => "$location",
                 "license_expire" => "$license_expire",
                 "license_status" => "$license_status",
                 "renew_contract" => "$renew_contract",
                 "id" => "$id",
                 "room_name" => "$room_name",
                 "room_detail" => $detail,
                 "room_facilities" => $facilities,
                 "room_capacity" => "$room_capacity",
                 "room_quantity" => "$room_quantity",
                 "room_type" => "$room_type",
                 "price" => "$price",
                 "more_detail" => $more_detailarray,
                 "rooms_image" => $array_image,
                 "other" => $otherarray,
                 "other_quantity" => $other_quantityarray,
                 "other_price" => "$other_price",


                 // "company_id" => "$company_id",
                 // "id" => "$room_id",
                 // // "company_name" => "$company_name",
                 // "room_name" => "$room_name",
                 // "rooms_image" => $array_image,
                 // "room_detail" => $detail,
                 // "room_facilities" => $facilities,
                 // "room_capacity" => "$room_capacity",
                 // "room_quantity" => "$room_quantity",
                 // "room_type" => "$room_type",
                 // "price" => "$price",
                 // "other" => $otherarray,
                 // "other_quantity" => $other_quantityarray,
                 // "other_price" => "$other_price",
                 // // "tel" => "$tel",
                 // // "email" => "$email",
                 // // "address" => "$address",
                 // // "location" => "$location",
                 // // "license_expire" => "$license_expire",
                 // // "license_status" => "$license_status",
                 // // "renew_contract" => "$renew_contract",
             );
         }
     }
     return $json = json_encode($data, JSON_UNESCAPED_UNICODE);
     // return response()->json($json);
     //  echo json_encode( $data, JSON_UNESCAPED_UNICODE );
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
