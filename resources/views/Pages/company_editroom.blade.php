@extends('adminlte::page')
@section('content')
    @php
        // $temp = [];
        // $room['rooms_image'] = trim($room['rooms_image'], '/,');
        // $temp = explode(',', $room['rooms_image']);
        // $temp = array_filter($temp);

        // รูปภาพห้องพัก
        $checkimage = $room->rooms_image;
        $room_images = explode(',', $checkimage);
        $roomimages = implode(',', $room_images);
        // รายละเอียดห้องพัก
        $room_detail = explode(',', $room->room_detail);
        $limitdetail = count($room_detail);
        // สิ่งอำนวยความสะดวก
        $room_facilities = explode(',', $room->room_facilities);
        $limitfacilities = count($room_facilities);
        // ของเสริม
        $other = explode(',', $room->other);
        $limitother = count($other);
        // จำนวนของเสริม
        $other_quantity = explode(',', $room->other_quantity);
        $limitother_quantity = count($other_quantity);

        // ของเสริม
        $more_detail = explode(',', $room->more_detail);
        $limitmore_detail = count($more_detail);
        // ประเภทห้องพัก
        $typeArray = explode(',', $type_room->type_room);
        $limittype = count($typeArray);
    @endphp

    <div class="container mt-2">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close float-end" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p><strong>{{ $message }}</strong></p>
            </div>
        @elseif ($message = Session::get('delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close float-end" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p><strong>{{ $message }}</strong></p>
            </div>
        @endif
    </div>
    <div class="container justify-content-center">
        <div class="container">
            <div class="card mt-4">
                <div class="card-header bg-warning border-warning">
                    <h3 class="card-title text-white">แก้ไขข้อมูลห้องพัก</h3>
                </div>
                <div class="card-body col-12">
                    @if ($checkimage != null || $checkimage != '')
                        <div id="carouselExampleControls" class="carousel" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($room_images as $key => $image)
                                    @if ($key == '0')
                                        <div class="carousel-item active">
                                            <div class="card">
                                                <div class="img-wrapper">
                                                    <img src="{{ $image }}" class="d-block w-100 showimgroom"
                                                        alt="รูปภาพห้องพัก">
                                                </div>
                                                <div class="card-body text-center">
                                                    <button class="btn btn-danger" type="button" data-toggle="modal"
                                                        data-target="#deleteimageModal"
                                                        onclick="selectDeleteImg('{{ $image }}',{{ $key }})">
                                                        ลบ
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($key != '0')
                                        <div class="carousel-item">
                                            <div class="card">
                                                <div class="img-wrapper">
                                                    <img src="{{ $image }}" class="d-block w-100 showimgroom"
                                                        alt="รูปภาพห้องพัก">
                                                </div>
                                                <div class="card-body text-center">
                                                    <button class="btn btn-danger" type="button" data-toggle="modal"
                                                        data-target="#deleteimageModal"
                                                        onclick="selectDeleteImg('{{ $image }}',{{ $key }})">
                                                        ลบ
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                        <div wire:ignore.self class="modal fade" id="deleteimageModal" tabindex="-1"
                            aria-labelledby="deleteimageModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteimageModalLabel">
                                            ยืนยันที่จะลบรูปภาพนี้</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ url('deleteimgroom', $room->id) }}" method="POST">
                                            @csrf

                                            <img class="img-fluid" id="img-delete">
                                            <input type="hidden" name="room_images" value="{{ $roomimages }}">
                                            <input type="text" id="index-delete" name="index_delete"
                                                style="display: none;" />
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">ยืนยัน</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    aria-label="Close">
                                                    ยกเลิก
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ url('update_room', $room->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <label class="active">เพิ่มรูปภาพห้องพัก</label>
                        <div class="input-images"></div>

                        <div class="mt-5">
                            <label>ชื่อห้องพัก</label>
                            <input type="text" name="room_name" value="{{ $room->room_name ?? '' }}"
                                class="form-control @error('room_name') is-invalid @enderror"
                                placeholder="กรอกชื่อห้องพัก เช่น เลขห้อง">
                            @error('room_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3" id="room_deteil">
                            <label>รายละเอียดห้องพัก</label>
                            <div class="form-row">
                                @for ($i = 0; $i < $limitdetail; $i++)
                                    @if ($i == '0')
                                        <div class="col-10">
                                            <input type="text" class="form-control" name="room_detail[]"
                                                class="form-control @error('room_detail') is-invalid @enderror"
                                                value="{{ $room_detail[$i] }}">
                                        </div>
                                        <div class="col-2">
                                            <td><button type="button" name="add" id="addroom_detail"
                                                    class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                        </div>
                                    @endif
                                    @if ($i != '0')
                                        <div class="col-10 mt-2" id="detail{{ $i }}">
                                            <input type="text" class="form-control" name="room_detail[]"
                                                class="form-control @error('room_detail') is-invalid @enderror"
                                                value="{{ $room_detail[$i] }}">
                                        </div>
                                        <div class="col-2 mt-2" id="detailbutton{{ $i }}">
                                            <td>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="removedetail('{{ $i }}')">
                                                    <i class="fa fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <div class="mt-3" id="room_facilities">
                            <label>สิ่งอำนวยความสะดวก</label>
                            <div class="form-row">
                                @for ($q = 0; $q < $limitfacilities; $q++)
                                    @if ($q == '0')
                                        <div class="col-10">
                                            <input type="text" class="form-control" name="room_facilities[]"
                                                class="form-control @error('room_facilities') is-invalid @enderror"
                                                value="{{ $room_facilities[$q] }}">
                                        </div>
                                        <div class="col-2">
                                            <td><button type="button" name="add" id="addroom_facilities"
                                                    class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                        </div>
                                    @endif
                                    @if ($q != '0')
                                        <div class="col-10 mt-2" id="facilities{{ $q }}">
                                            <input type="text" class="form-control" name="room_facilities[]"
                                                class="form-control @error('room_facilities') is-invalid @enderror"
                                                value="{{ $room_facilities[$q] }}">
                                        </div>
                                        <div class="col-2 mt-2" id="facilitiesbutton{{ $q }}">
                                            <td>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="removefacilities('{{ $q }}')">
                                                    <i class="fa fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <div class="mt-3">
                            <label>จำนวนคนที่รองรับ</label>
                            <input type="number" value="{{ $room->room_capacity ?? '' }}" name="room_capacity"
                                min="1" class="form-control @error('room_capacity') is-invalid @enderror"
                                placeholder="จำนวนคนที่รองรับของห้องพัก">
                            @error('room_capacity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label>จำนวนห้องพัก</label>
                            <input type="number" min="0" value="{{ $room->room_quantity ?? '' }}"
                                name="room_quantity" class="form-control @error('room_quantity') is-invalid @enderror"
                                placeholder="จำนวนของห้องพัก">
                            @error('room_quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label>ประเภทห้องพัก</label>
                            <select class="form-control text-center" name="room_type">
                                <option hidden select value="{{ $room->room_type }}">{{ $room->room_type }}</option>
                                @for ($i = 0; $i < $limittype; $i++)
                                    <option value="{{ $typeArray[$i] }}">{{ $typeArray[$i] }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="mt-3">
                            <label>ราคาห้องพัก</label>
                            <input type="number" value="{{ $room->price ?? '' }}" name="price" min="1"
                                class="form-control @error('price') is-invalid @enderror" placeholder="ราคาของห้องพัก">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3" id="other">
                            <label>ของเสริม</label>
                            <div class="form-row">
                                @for ($q = 0; $q < $limitother; $q++)
                                    @for ($q = 0; $q < $limitother_quantity; $q++)
                                        @if ($q == '0')
                                            <div class="col-8">
                                                <input type="text" class="form-control" name="other[]"
                                                    class="form-control @error('other') is-invalid @enderror"
                                                    value="{{ $other[$q] }}">
                                            </div>
                                            <div class="col-2">
                                                <input type="number" min="0" name="other_quantity[]"
                                                    class="form-control @error('other_quantity') is-invalid @enderror"
                                                    value="{{ $other_quantity[$q] }}">
                                            </div>
                                            <div class="col-2">
                                                <td><button type="button" name="add" id="addother"
                                                        class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                            </div>
                                        @endif
                                        @if ($q != '0')
                                            <div class="col-8 mt-2" id="other{{ $q }}">
                                                <input type="text" class="form-control" name="other[]"
                                                    class="form-control @error('other') is-invalid @enderror"
                                                    value="{{ $other[$q] }}">
                                            </div>
                                            <div class="col-2 mt-2" id="other_quantity{{ $q }}">
                                                <input type="number" min="0" name="other_quantity[]"
                                                    class="form-control @error('other_quantity') is-invalid @enderror"
                                                    value="{{ $other_quantity[$q] }}">
                                            </div>
                                            <div class="col-2 mt-2" id="otherbutton{{ $q }}">
                                                <td>
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="removeother('{{ $q }}')">
                                                        <i class="fa fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </div>
                                        @endif
                                    @endfor
                                @endfor
                            </div>
                        </div>
                        {{-- <div class="mt-3" id="other">
                            <label>ของเสริม</label>
                            <div class="form-row">
                                <div class="col-8">
                                    <input type="text" class="form-control" name="other[]"
                                        class="form-control @error('other') is-invalid @enderror"
                                        placeholder="กรอกของเสริม">
                                </div>
                                <div class="col-2">
                                    <input type="number" min="0" name="other_quantity[]"
                                        class="form-control @error('other_quantity') is-invalid @enderror"
                                        placeholder="จำนวน">
                                </div>
                                <div class="col-2">
                                    <td><button type="button" name="add" id="addother" class="btn btn-success"><i
                                                class="fa fa-plus"></i></button></td>
                                </div>
                            </div>
                        </div> --}}

                        <div class="mt-3">
                            <label>ราคาของเสริม</label>
                            <input type="number" value="{{ $room->other_price ?? '' }}" name="other_price"
                                min="1" class="form-control @error('other_price') is-invalid @enderror"
                                placeholder="ราคาของเสริม">
                            @error('other_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3" id="more_detail">
                            <label>รายละเอียดเพิ่มเติมของห้อง</label>
                            <div class="form-row">
                                @for ($i = 0; $i < $limitmore_detail; $i++)
                                    @if ($i == '0')
                                        <div class="col-10">
                                            <input type="text" class="form-control" name="more_detail[]"
                                                class="form-control @error('more_detail') is-invalid @enderror"
                                                value="{{ $more_detail[$i] }}">
                                        </div>
                                        <div class="col-2">
                                            <td><button type="button" name="add" id="addmore_detail"
                                                    class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                        </div>
                                    @endif
                                    @if ($i != '0')
                                        <div class="col-10 mt-2" id="more_detail{{ $i }}">
                                            <input type="text" class="form-control" name="more_detail[]"
                                                class="form-control @error('more_detail') is-invalid @enderror"
                                                value="{{ $more_detail[$i] }}">
                                        </div>
                                        <div class="col-2 mt-2" id="more_detailbutton{{ $i }}">
                                            <td>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="removemore_detail('{{ $i }}')">
                                                    <i class="fa fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <div class="col-lg-12 text-center mt-2 mb-3 ">
                            <button type="submit" class="btn btn-success col-3">ยืนยัน</button>
                            <button type="button" class="btn btn-secondary col-3"
                                onclick="window.location.href='{{ url('manageroom') }}'">ย้อนกลับ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
