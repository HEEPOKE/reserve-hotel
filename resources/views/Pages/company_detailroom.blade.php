@extends('adminlte::page')
@section('content')
    @php
        // รูปภาพห้องพัก
        $checkimage = $room->rooms_image;
        $room_images = explode(',', $checkimage);
        $roomimages = implode(',', $room_images);
        // รายละเอียดห้องพัก
        $room_detail = explode(',', $room->room_detail);
        $limitdetail = count($room_detail) ?? '';
        // สิ่งอำนวยความสะดวก
        $room_facilities = explode(',', $room->room_facilities);
        $limit_facilities = count($room_facilities) ?? '';
        // ของเสริม
        $other = explode(',', $room->other);
        $limit_other = count($other) ?? '';
        // จำนวนของเสริม
        $other_quantity = explode(',', $room->other_quantity);
        $limit_other_quantity = count($other_quantity) ?? '';

        // รายละเอียดเพิ่มเติมของห้อง
        $more_detail = explode(',', $room->more_detail);
        $limit_more_detail = count($more_detail) ?? '';

        $image_room = $room->rooms_image;
        $arrayimageroom = explode(',', $image_room);
    @endphp
    <div class="container justify-content-center  mt-2">
        <div class="container">
            <div class="card">
                <div class="card-header bgtable border-info">
                    <h3 class="card-title text-white">รายละเอียดห้องพัก {{ $room->room_name }}</h3>
                </div>
                <div class="card-body col-12">
                    @if ($checkimage != null || $image_room != '')
                        <label class="ms-3">รูปภาพสลิป</label>
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
                                            </div>
                                        </div>
                                    @endif
                                    @if ($key != '0')
                                        <div class="carousel-item">
                                            <div class="card">
                                                <div class="img-wrapper mx-2">
                                                    <img src="{{ $image }}" class="d-block showimgroom"
                                                        alt="รูปภาพห้องพัก">
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
                    @endif

                    <div class="mt-3">
                        <label>รายละเอียดของห้องพัก</label>
                        <ul class="listroom">
                            @for ($i = 0; $i < $limitdetail; $i++)
                                <li>{{ $room_detail[$i] }}</li>
                            @endfor
                        </ul>
                    </div>
                    <div class="mt-3">
                        <label>สิ่งอำนวยความสะดวก</label>
                        <ul class="listroom">
                            @for ($i = 0; $i < $limit_facilities; $i++)
                                <li>{{ $room_facilities[$i] }}</li>
                            @endfor
                        </ul>
                    </div>
                    <div class="mt-3">
                        <label>ของเสริม</label>
                        <ul class="listroom">
                            @for ($i = 0; $i < $limit_other; $i++)
                                @for ($i = 0; $i < $limit_other_quantity; $i++)
                                    <li>{{ $other[$i] }} {{ $other_quantity[$i] }}</li>
                                @endfor
                            @endfor
                        </ul>
                    </div>
                    @if ($room->other_price != null)
                        <div class="mt-3">
                            <label>ราคาของเสริม</label>
                            <ul class="listroom">
                                <li>{{ $room->other_price }} บาท</li>
                            </ul>
                        </div>
                    @endif
                    <div class="mt-3">
                        <label>รายละเอียดเพิ่มเติมของห้อง</label>
                        <ul class="listroom">
                            @for ($i = 0; $i < $limit_more_detail; $i++)
                                <li>{{ $more_detail[$i] }}</li>
                            @endfor
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12 text-center mt-2 mb-3 ">
                    <button type="button" class="btn btn-secondary col-3"
                        onclick="window.location.href='{{ url('manageroom') }}'">ย้อนกลับ</button>
                </div>
            </div>
        </div>
    </div>
@endsection
