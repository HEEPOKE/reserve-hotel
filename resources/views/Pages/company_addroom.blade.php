@extends('adminlte::page')
@section('content')
    <div class="container justify-content-center">
        <form action="{{ url('insert_room') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="card mt-4">
                    <div class="card-header bg-success border-success">
                        <h3 class="card-title">เพิ่มรูปภาพห้องพัก</h3>
                    </div>
                    <div class="card-body">

                        <input type="hidden" name="company_id" value="{{ Auth::user()->company_id }}">

                        <div class="input-images"></div>

                        <div class="mt-3">
                            <label>ชื่อห้องพัก</label>
                            <input type="text" name="room_name"
                                class="form-control @error('room_name') is-invalid @enderror"
                                placeholder="กรอกชื่อห้องพัก เช่น เลขห้อง">
                            @error('room_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3" id="room_deteil">
                            <label>รายละเอียดห้องพัก</label>
                            <div class="form-row">
                                <div class="col-10">
                                    <input type="text" class="form-control" name="room_detail[]"
                                        class="form-control @error('room_detail') is-invalid @enderror"
                                        placeholder="กรอกรายละเอียดของห้องพัก">
                                </div>
                                <div class="col-2">
                                    <td><button type="button" name="add" id="addroom_detail" class="btn btn-success"><i
                                                class="fa fa-plus"></i></button></td>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3" id="room_facilities">
                            <label>สิ่งอำนวยความสะดวก</label>
                            <div class="form-row">
                                <div class="col-10">
                                    <input type="text" class="form-control" name="room_facilities[]"
                                        class="form-control @error('room_facilities') is-invalid @enderror"
                                        placeholder="กรอกสิ่งอำนวยความสะดวกภายในห้องพัก">
                                </div>
                                <div class="col-2">
                                    <td><button type="button" name="add" id="addroom_facilities"
                                            class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label>จำนวนคนที่รองรับ</label>
                            <input type="number" name="room_capacity" min="1"
                                class="form-control @error('room_capacity') is-invalid @enderror"
                                placeholder="จำนวนคนที่รองรับของห้องพัก">
                            @error('room_capacity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label>จำนวนห้องพัก</label>
                            <input type="number" min="0" name="room_quantity"
                                class="form-control @error('room_quantity') is-invalid @enderror"
                                placeholder="จำนวนของห้องพัก">
                            @error('room_quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label>ประเภทห้องพัก</label>
                            <input type="text" name="room_type" class="form-control" value="{{ $typeroom }}"
                                readonly>
                        </div>
                        <div class="mt-3">
                            <label>ราคาห้องพัก</label>
                            <input type="number" name="price" min="1"
                                class="form-control @error('price') is-invalid @enderror" placeholder="ราคาของห้องพัก">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3" id="other">
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
                        </div>
                        <div class="mt-3">
                            <label>ราคาของเสริม</label>
                            <input type="number" name="other_price" min="1"
                                class="form-control  @error('other_price') is-invalid @enderror"
                                placeholder="ราคาห้องเสริม">
                        </div>
                        <div class="mt-3" id="more_detail">
                            <label>รายละเอียดเพิ่มเติมของห้อง</label>
                            <div class="form-row">
                                <div class="col-10">
                                    <input type="text" class="form-control" name="more_detail[]"
                                        class="form-control @error('more_detail') is-invalid @enderror"
                                        placeholder="กรอกรายละเอียดเพิ่มเติมของห้อง">
                                </div>
                                <div class="col-2">
                                    <td><button type="button" name="add" id="addmore_detail"
                                            class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 text-center mt-2 mb-3 ">
                        <button type="submit" class="btn btn-success col-3">ยืนยัน</button>
                        <button type="button" class="btn btn-secondary col-3"
                            onclick="window.location.href='{{ url('manage_typeroom') }}'">ย้อนกลับ</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
