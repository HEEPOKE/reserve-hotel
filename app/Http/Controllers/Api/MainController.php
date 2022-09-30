<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rooms;
use App\Models\Companies;
use App\Models\Customers;
use App\Models\Reserve;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    public function index()
    {

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
                $company_name = $room[$i]->company_name ?? 'company_name';
                $tel = $room[$i]->tel ?? 'tel';
                $email = $room[$i]->email ?? 'email';
                $address = $room[$i]->address ?? 'address';
                $location = $room[$i]->location ?? 'location';

                $rooms[$i] = array(
                    "id" => "$room_id",
                    "room_name" => "$room_name",
                    "rooms_image" => $array_image,
                    "rooms_detail" => $detail,
                    "rooms_facilities" => $facilities,
                    "room_capacity" => "$room_capacity",
                    "room_quantity" => "$room_quantity",
                    "room_type" => "$room_type",
                    "price" => "$price",
                    "company_name" => "$company_name",
                    "tel" => "$tel",
                    "email" => "$email",
                    "address" => "$address",
                    "location" => "$location",
                );

                $data = array(
                    "year" => $rooms,
                );
            }
        }

        return response()->json($data);
    }
}
