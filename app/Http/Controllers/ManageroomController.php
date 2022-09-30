<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rooms;
use App\Models\Typeroom;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Concerns\InteractsWithInput;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class ManageroomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.company_typeroom');
    }

    public function manageroom()
    {
        $rooms = Rooms::orderBy('id', 'desc')
            ->where('company_id', auth()->user()->company_id)
            ->paginate(10);

        return view('pages.company_manageroom', compact('rooms'));
        // echo json_ encode( $data, JSON_UNESCAPED_UNICODE );
    }

    public function jsonmanageroom()
    {
        $rooms = Rooms::orderBy('id', 'asc')
            ->where('company_id', auth()->user()->company_id)
            ->get();

        // return view('pages.company_manageroom', $data);
        echo json_encode(compact('rooms'), JSON_UNESCAPED_UNICODE);
    }

    public function addroom($id)
    {
        $typeroom = $id;

        return view('pages.company_addroom', compact('typeroom'));
    }

    public function detailroom($id)
    {

        $room = Rooms::find($id);
        return view('pages.company_detailroom', compact('room'));
    }

    public function editroom($id)
    {
        $room = Rooms::find($id);

        $type_room = DB::table('typerooms')
            ->select('type_room')
            ->where('company_id', auth()->user()->company_id)
            ->first();

        return view('pages.company_editroom', compact('room', 'type_room'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'company_id' => 'required',
            'room_name' => 'required',
            'room_detail' => 'required',
            'room_facilities' => 'required',
            'room_capacity' => 'required',
            'room_quantity' => 'required',
            'room_type' => 'required',
            'price' => 'required',
            'rooms_image' => 'nullable',
            'other' => 'required',
            'other_quantity' => 'required',
            'other_price' => 'nullable',
            // 'rooms_image.*' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        date_default_timezone_set("Asia/Bangkok");

        $room_name = $request->input('room_name');

        $rooms = new rooms();
        $rooms->company_id = $request->input('company_id');
        $rooms->room_name = $room_name;
        $rooms->room_capacity = $request->input('room_capacity');
        $rooms->room_quantity = $request->input('room_quantity');
        $rooms->room_type = $request->input('room_type');
        $rooms->price = $request->input('price');

        // รายละเอียดห้องพัก
        $request_detail = $request->input('room_detail');
        $room_detail = implode(",", $request_detail);

        // สิ่งอำนวยความสะดวก
        $request_facilities = $request->input('room_facilities');
        $room_facilities = implode(",", $request_facilities);

        $input = $request->all();
        $images = array();
        if ($files = $request->file('rooms_image')) {
            foreach ($files as $file) {
                $name = '/rooms_image/' . rand(1, 10000) . date("dmYHis") . '.' . $file->extension();
                $file->move('rooms_image', $name);
                $images[] = $name;
            }
            $imageall = implode(",", $images);
        }

        $rooms->room_detail = $room_detail;
        $rooms->room_facilities = $room_facilities;
        $rooms->rooms_image = $imageall;

        // ของเสริม
        $request_other = $request->input('other');
        $other = implode(",", $request_other);

        $rooms->other = $other;

        // จำนวนของเสริม
        $request_other_quantity = $request->input('other_quantity');
        $other_quantity = implode(",", $request_other_quantity);

        $rooms->other_quantity = $other_quantity;
        $rooms->other_price = $request->input('other_price');

        // รายละเอียดเพิ่มเติม
        $request_more_detail = $request->input('more_detail');
        $more_detail = implode(",", $request_more_detail);
        $rooms->more_detail = $more_detail;


        $rooms->save();
        return redirect('/manageroom')->with('status', 'เพิ่มห้องพักสำเร็จ');
    }

    public function update_room(Request $request, $id)
    {

        $request->validate([
            'room_name' => 'required',
            'room_detail' => 'required',
            'room_facilities' => 'required',
            'room_capacity' => 'required',
            'room_quantity' => 'required',
            'room_type' => 'required',
            'price' => 'required',
            'rooms_image' => 'nullable',
            // 'other' => 'required',
            // 'other_quantity' => 'required',
            // 'other_price' => 'required',
            // 'rooms_image.*' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        date_default_timezone_set("Asia/Bangkok");

        $room_name = $request->input('room_name');

        $rooms = Rooms::find($id);
        $rooms->room_name = $room_name;
        $rooms->room_capacity = $request->input('room_capacity');
        $rooms->room_quantity = $request->input('room_quantity');
        $rooms->room_type = $request->input('room_type');
        $rooms->price = $request->input('price');

        // รายละเอียดห้องพัก
        $request_detail = $request->input('room_detail');
        $room_detail = implode(",", $request_detail);

        // สิ่งอำนวยความสะดวก
        $request_facilities = $request->input('room_facilities');
        $room_facilities = implode(",", $request_facilities);

        $input = $request->all();
        $images = array();
        if ($files = $request->file('rooms_image')) {
            foreach ($files as $file) {
                $name = '/rooms_image/' . rand(1, 10000) . date("dmYHis") . '.' . $file->extension();
                $file->move('rooms_image', $name);
                $images[] = $name;
            }
            $imageall = implode(",", $images);
        }

        $old_image = $rooms->rooms_image;
        $checkimg = $request->file('rooms_image');

        if ($old_image == NULL && $checkimg != NULL) {
            $rooms->rooms_image = $imageall;
        } elseif ($old_image != NULL && $checkimg != NULL) {
            $new_image = $old_image . "," . $imageall;
            $rooms->rooms_image = $new_image;
        } elseif ($old_image != NULL && $checkimg == NULL) {
            $rooms->rooms_image = $old_image;
        }

        $rooms->room_detail = $room_detail;
        $rooms->room_facilities = $room_facilities;

        // ของเสริม
        $request_other = $request->input('other');
        $other = implode(",", $request_other);
        $rooms->other = $other;

        // จำนวนของเสริม
        $request_other_quantity = $request->input('other_quantity');
        $other_quantity = implode(",", $request_other_quantity);
        $rooms->other_quantity = $other_quantity;

        $rooms->other_price = $request->input('other_price');

        // รายละเอียดเพิ่มเติม
        $request_more_detail = $request->input('more_detail');
        $more_detail = implode(",", $request_more_detail);
        $rooms->more_detail = $more_detail;

        $rooms->save();
        return redirect('/manageroom')->with('success', 'เเก้ไขข้อมูลห้องพักสำเร็จ');
    }

    public function delete_room($id)
    {
        $rooms = Rooms::find($id);
        $rooms->delete();
        return redirect('/manageroom')->with('delete', 'ลบห้องพักสำเร็จ');
    }

    public function deleteimgroom(Request $request, $id)
    {
        $request->validate([
            'index_delete' => 'required',
            'room_images' => 'required',
        ]);

        $room = Rooms::find($id);
        $indexDelete = $request->input('index_delete');
        $request_images = $request->input('room_images');
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

        if (File::exists(public_path($delete_image))) {
            File::delete(public_path($delete_image));
        }

        $room->rooms_image = $result;

        $room->save();
        return redirect('/editroom/' . $id)->with('delete', 'ลบรูปภาพสำเร็จ');
    }

    public function add_typeroom(Request $request, $id)
    {

        $request->validate([
            'company_id' => 'required',
            'typeroom' => 'required',
        ]);

        $company_id = $request->input('company_id');
        $typeArray = $request->input('typeroom');
        $typeroomString = implode(',', $typeArray);

        if ($id == '0') {

            $typeroom = new Typeroom();
            $typeroom->company_id = $company_id;
            $typeroom->type_room = $typeroomString;
        } else {

            $typeroom = Typeroom::find($id);

            $oldtype = $typeroom->type_room;
            $result = $oldtype . ',' . $typeroomString;

            $typeroom->type_room = $result;
        }

        $typeroom->save();

        return redirect('manage_typeroom')->with('success', 'เพิ่มข้อมูลประเภทห้องพักสำเร็จ');
    }

    public function deletetye(Request $request, $id)
    {
        $request->validate([
            'typeroom' => 'required',
            'index_delete' => 'required',
        ]);

        $type = Typeroom::find($id);
        $indexDelete = $request->input('index_delete');
        $request_type = $request->input('typeroom');
        $type_array = explode(",", $request_type);

        array_splice($type_array, $indexDelete, 1);

        $limit = count($type_array);

        $result = "";

        for ($i = 0; $i < $limit; $i++) {
            if ($i + 1 == $limit) {
                $result .= $type_array[$i];
            } else {
                $result .= $type_array[$i] . ",";
            }
        }

        $type->type_room = $result;
        $type->save();

        return redirect('manage_typeroom')->with('delete', 'ลบประเภทห้องพักสำเร็จ');
    }
}
