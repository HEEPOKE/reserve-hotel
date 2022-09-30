@extends('adminlte::page')
<style>
    /*left right modal*/
    .modal.left_modal,
    .modal.right_modal {
        position: fixed;
        z-index: 99999;
    }

    .modal.left_modal .modal-dialog,
    .modal.right_modal .modal-dialog {
        position: fixed;
        margin: 1.5%;
        width: 32%;
        height: 55%;
        left: 10%;
        /* -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
        -o-transform: translate3d(0%, 0, 0);
        transform: translate3d(0%, 0, 0); */
    }

    .modal-dialog {
        /* max-width: 100%; */
        /* margin: 1.75rem auto; */
    }

    @media (min-width: 576px) {
        .left_modal .modal-dialog {
            /* max-width: 100%; */
        }

        .right_modal .modal-dialog {
            /* max-width: 100%; */
        }
    }

    .modal.left_modal .modal-content,
    .modal.right_modal .modal-content {
        /*overflow-y: auto;
    overflow-x: hidden;*/
        /* height: 100vh !important; */
    }

    .modal.left_modal .modal-body,
    .modal.right_modal .modal-body {
        /* padding: 15px 15px 30px; */
    }

    /*.modal.left_modal  {
    pointer-events: none;
    background: transparent;
    }*/

    /*Left*/
    .modal.left_modal.fade .modal-dialog {
        left: -50%;
        -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
        -o-transition: opacity 0.3s linear, left 0.3s ease-out;
        transition: opacity 0.3s linear, left 0.3s ease-out;
    }

    .modal.left_modal.fade.show .modal-dialog {
        left: 0;
        box-shadow: 0px 0px 19px rgba(0, 0, 0, .5);
    }

    /*Right*/
    .modal.right_modal.fade .modal-dialog {
        /* right: -50%; */
        -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
        -o-transition: opacity 0.3s linear, right 0.3s ease-out;
        transition: opacity 0.3s linear, right 0.3s ease-out;
    }



    .modal.right_modal.fade.show .modal-dialog {
        right: 0;
        box-shadow: 0px 0px 19px rgba(0, 0, 0, .5);
    }

    /* ----- MODAL STYLE ----- */
    .modal-content {
        border-radius: 0;
        border: none;
    }



    .modal-header.left_modal,
    .modal-header.right_modal {

        /* padding: 10px 15px; */
        border-bottom-color: #EEEEEE;
        background-color: #FAFAFA;
    }

    .modal_outer .modal-body {
        /*height:90%;*/
        overflow-y: auto;
        overflow-x: hidden;
        /* height: 91vh; */
    }
</style>
@section('content')
    @php

        $company_id = Auth::user()->company_id;

        $findid = DB::table('typerooms')
            ->select('id')
            ->where('company_id', $company_id)
            ->first();

        $id = $findid->id ?? '0';

        $type = DB::table('typerooms')
            ->select('type_room')
            ->where('company_id', $company_id)
            ->where('id', $id)
            ->first();

        $check = $type->type_room ?? null;

        if ($check == null) {
            $counttype = 0;
        } else {
            $Arraytype = explode(',', $check);
            $Stringtype = implode(',', $Arraytype);
            $counttype = count($Arraytype);
        }
    @endphp
    <div class="card mt-3">
        {{-- {{ $currentURL }} --}}

        <div class="wrapper_all">
            <div class="card-header border-info bgtable mb-2">
                <h3 class="card-title text-white">ข้อมูลการจอง</h3>
                <button type="button" class="btn btn-success float-end mr-2" data-toggle="modal"
                    data-target="#insertreserveModal">เพิ่มการจอง</button>
            </div>

            {{-- <div class="row">
                    <div class="row col-3">
                        <div class="">
                            <input class="form-control" type="text" id="search_input_all"
                                onkeyup="FilterkeyWord_all_table()" placeholder="ค้นหาชื่อ.." title="Type in a name">
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-success float-end mr-2" data-toggle="modal"
                            data-target="#sendmailModal">ส่งเมลล์</button>
                    </div> --}}

            @include('layouts.company_reserve.insert_reserve')

            <div class="container">
                <table class="table table-bordered mt-3 text-center dtr-inline" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">ลำดับ</th>
                            <th class="text-center">ชื่อลูกค้า</th>
                            <th class="text-center">ชื่อห้องที่จอง</th>
                            <th class="text-center">ระบุตัวตน</th>
                            <th class="text-center">สถานะเข้าพัก</th>
                            <th class="text-center">สถานะการชำระเงิน</th>
                            <th class="text-center col-2">จัดการข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reserves as $key => $row)
                        {{ $reserves }}
                        @if ($row->booking_id == $currentURL)
                        <tr>
                            <td class="text-center">{{ $key + $reserves->firstItem() }}</td>
                            <td class="text-center">{{ $row->first_name }}</td>
                            <td class="text-center">{{ $row->room_name }}</td>

                            @if ($row->identity_card == '')
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning"
                                        onclick="openmodal({{ $row->id }})">
                                        <i class="fa fa-id-card-o" aria-hidden="true"></i></button>
                                </td>
                            @else
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-warning"
                                            onclick="openmodal({{ $row->id }})">
                                            <i class="fa fa-id-card-o" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#cardshowModal{{ $row->id }}"><i
                                                class="fas fa-eye"></i></button>
                                    </div>
                                </td>
                            @endif

                            @if ($row->stay_status == '0')
                                <td class="text-center"><button class="btn btn-outline-warning col-7"
                                        data-toggle="modal"
                                        data-target="#checkreserveModal{{ $row->id }}">รอเช็คอิน</button>
                                </td>
                            @elseif($row->stay_status == '1')
                                <td class="text-center"><button class="btn btn-outline-success col-7"
                                        data-toggle="modal"
                                        data-target="#checkreserveModal{{ $row->id }}">เช็คอิน</button>
                                </td>
                            @else
                                <td class="text-center"><button class="btn btn-outline-danger col-7" data-toggle="modal"
                                        data-target="#checkreserveModal{{ $row->id }}">เช็คเอ้าท์</button>
                                </td>
                            @endif
                            @if ($row->payment_status == '0')
                                <td class="text-center"><button class="btn btn-outline-secondary"
                                        data-toggle="modal"
                                        data-target="#paymentreserveModal{{ $row->id }}">ยังไม่ชำระ</button>
                                </td>
                            @elseif($row->payment_status == '2')
                                <td class="text-center"><button class="btn btn-outline-warning"
                                        data-toggle="modal"
                                        data-target="#paymentreserveModal{{ $row->id }}">มัดจำ</button>
                                </td>
                            @else
                                <td class="text-center"><button class="btn btn-outline-success"
                                        data-toggle="modal"
                                        data-target="#paymentreserveModal{{ $row->id }}">ชำระเต็ม</button>
                                </td>
                            @endif
                            <td class="text-center">
                                <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#viewreserveModal{{ $row->id }}"><i
                                        class="fas fa-eye"></i></button>
                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="#editreserveModal{{ $row->id }}"><i
                                        class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#deletereserveModal{{ $row->id }}"><i
                                        class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        @else

                        @endif
                            {{-- <tr>
                                <td class="text-center">{{ $key + $reserves->firstItem() }}</td>
                                <td class="text-center">{{ $row->first_name }}</td>
                                <td class="text-center">{{ $row->room_name }}</td>

                                @if ($row->identity_card == '')
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning"
                                            onclick="openmodal({{ $row->id }})">
                                            <i class="fa fa-id-card-o" aria-hidden="true"></i></button>
                                    </td>
                                @else
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-warning"
                                                onclick="openmodal({{ $row->id }})">
                                                <i class="fa fa-id-card-o" aria-hidden="true"></i></button>
                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#cardshowModal{{ $row->id }}"><i
                                                    class="fas fa-eye"></i></button>
                                        </div>
                                    </td>
                                @endif

                                @if ($row->stay_status == '0')
                                    <td class="text-center"><button class="btn btn-outline-warning col-7"
                                            data-toggle="modal"
                                            data-target="#checkreserveModal{{ $row->id }}">รอเช็คอิน</button>
                                    </td>
                                @elseif($row->stay_status == '1')
                                    <td class="text-center"><button class="btn btn-outline-success col-7"
                                            data-toggle="modal"
                                            data-target="#checkreserveModal{{ $row->id }}">เช็คอิน</button>
                                    </td>
                                @else
                                    <td class="text-center"><button class="btn btn-outline-danger col-7" data-toggle="modal"
                                            data-target="#checkreserveModal{{ $row->id }}">เช็คเอ้าท์</button>
                                    </td>
                                @endif
                                @if ($row->payment_status == '0')
                                    <td class="text-center"><button class="btn btn-outline-secondary"
                                            data-toggle="modal"
                                            data-target="#paymentreserveModal{{ $row->id }}">ยังไม่ชำระ</button>
                                    </td>
                                @elseif($row->payment_status == '2')
                                    <td class="text-center"><button class="btn btn-outline-warning"
                                            data-toggle="modal"
                                            data-target="#paymentreserveModal{{ $row->id }}">มัดจำ</button>
                                    </td>
                                @else
                                    <td class="text-center"><button class="btn btn-outline-success"
                                            data-toggle="modal"
                                            data-target="#paymentreserveModal{{ $row->id }}">ชำระเต็ม</button>
                                    </td>
                                @endif
                                <td class="text-center">
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#viewreserveModal{{ $row->id }}"><i
                                            class="fas fa-eye"></i></button>
                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-target="#editreserveModal{{ $row->id }}"><i
                                            class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#deletereserveModal{{ $row->id }}"><i
                                            class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr> --}}
                    </tbody>

                    @php
                        $checkpayment_slip = $row->payment_slip;
                        $paymentimg = $checkpayment_slip;
                        $payment_status = $row->payment_status;
                        $slipimg = explode(',', $checkpayment_slip);
                        $payment_slip = implode(',', $slipimg);
                    @endphp

                    <!-- showleft Modal -->
                    <!-- left modal -->
                    <div wire:ignore.self class="modal fade" id="cardshowModal{{ $row->id }}" tabindex="-1"
                        aria-labelledby="cardshowModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header card-header bg-purple  border-purple ">
                                    <h5 class="modal-title" id="cardshowModalLabel">
                                        ดูบัตรประชาชน</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="mt-3">

                                        <div class="row">
                                            <div class="col-4 mt-2">
                                                <p>บัตรประชาชน</p>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" class="form-control"
                                                    value="{{ $row->identity_card }}" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 mt-2">
                                                <p>ตัวนำหน้า(ไทย)</p>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" class="form-control"
                                                    value="{{ $row->name_prefixth }}" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 mt-2">
                                                <p>ชื่อ(ไทย)</p>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" class="form-control"
                                                    value="{{ $row->first_nameth }}" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 mt-2">
                                                <p>นามสกุล(ไทย)</p>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" class="form-control"
                                                    value="{{ $row->last_nameth }}" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 mt-2">
                                                <p>ตัวนำหน้า(อังกฤษ)</p>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" class="form-control"
                                                    value="{{ $row->name_prefixen }}" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 mt-2">
                                                <p>ชื่อ(อังกฤษ)</p>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" class="form-control"
                                                    value="{{ $row->first_nameen }}" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 mt-2">
                                                <p>นามสกุล(อังกฤษ)</p>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" class="form-control"
                                                    value="{{ $row->last_nameen }}" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 mt-2">
                                                <p>เกิดวันที่</p>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" class="form-control" value="{{ $row->birthdate }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 mt-2">
                                                <p>เพศ</p>
                                            </div>
                                            <div class="col-8">
                                                @if ($row->gender == 1)
                                                    @php
                                                        $row->gender = 'ชาย';
                                                    @endphp
                                                @else
                                                    @php
                                                        $row->gender = 'หญิง';
                                                    @endphp
                                                @endif
                                                <input type="text" class="form-control" value="{{ $row->gender }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 mt-2">
                                                <p>ที่อยู่</p>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" class="form-control" value="{{ $row->inhabited }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 mt-2">
                                                <p>ตำบล</p>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" class="form-control" value="{{ $row->tumbol }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 mt-2">
                                                <p>อำเภอ</p>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" class="form-control" value="{{ $row->amphur }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 mt-2">
                                                <p>ซอย</p>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" class="form-control" value="{{ $row->soi }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 mt-2">
                                                <p>ถนน</p>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" class="form-control" value="{{ $row->street }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 mt-2">
                                                <p>จังหวัด</p>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" class="form-control" value="{{ $row->province }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-info" data-toggle="modal"
                                        data-target="#cardshowleftModal{{ $row->id }}">
                                        <-- ดูข้อมูลเปรียบเทียบ</button>
                                            <button type="button" class="btn btn-secondary" wire:click="closeModal"
                                                data-dismiss="modal">ยกเลิก</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- showleft Modal -->
                    <!-- left modal -->
                    <div wire:ignore.self class="modal modal_outer left_modal fade"
                        id="cardshowleftModal{{ $row->id }}" tabindex="-1"
                        aria-labelledby="cardshowleftModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header card-header bg-purple  border-purple ">
                                    <h5 class="modal-title" id="cardshowleftModalLabel">
                                        รายชื่อลูกค้าที่จอง</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-4 mt-2">
                                            <p>ชื่อ</p>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" value="{{ $row->first_name }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 mt-2">
                                            <p>นามสกุล</p>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" value="{{ $row->last_name }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 mt-2">
                                            <p>เบอร์โทร</p>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" value="{{ $row->tel }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 mt-2">
                                            <p>อีเมล</p>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" value="{{ $row->email }}"
                                                readonly>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                                        data-dismiss="modal">ยกเลิก</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- check Modal -->
                    <div wire:ignore.self class="modal fade" id="checkreserveModal{{ $row->id }}" tabindex="-1"
                        aria-labelledby="checkreserveModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header card-header bg-purple  border-purple ">
                                    <h5 class="modal-title" id="checkreserveModalLabel">เเก้ไขสถานะเข้าพัก</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ url('check-reserves', $row->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mt-3">
                                            <label>สถานะเข้าพัก</label>
                                            <select class="form-control" name="stay_status">
                                                @if ($row->stay_status == '0')
                                                    @php
                                                        $check = 'รอเช็คอิน';
                                                    @endphp
                                                @elseif($row->stay_status == '1')
                                                    @php
                                                        $check = 'เช็คอิน';
                                                    @endphp
                                                @else
                                                    @php
                                                        $check = 'เช็คเอ้าท์';
                                                    @endphp
                                                @endif
                                                <option hidden selected value="{{ $row->stay_status }}">
                                                    {{ $check }}</option>
                                                <option value="0">รอเช็คอิน</option>
                                                <option value="1">เช็คอิน</option>
                                                <option value="2">เช็คเอ้าท์</option>
                                            </select>
                                        </div>
                                    </div>
                                    @if ($message = Session::get('successcheckin'))
                                        <script>
                                            Swal.fire({
                                                title: 'แก้ไขสถานะเข้าพักสำเร็จ!',
                                                text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                                                icon: 'success'
                                            });
                                        </script>
                                    @else
                                    @endif
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">ยืนยัน</button>
                                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                                            data-dismiss="modal">ยกเลิก</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- view Modal -->
                    <div wire:ignore.self class="modal fade" id="viewreserveModal{{ $row->id }}" tabindex="-1"
                        aria-labelledby="viewreserveModalLabel" aria-hidden="true">
                        <div class="modal-dialog xl-logM">
                            <div class="modal-content">
                                <div class="modal-header card-header bg-primary border-primary">
                                    <h5 class="modal-title" id="viewreserveModalLabel">รายละเอียดการจอง
                                    </h5>
                                    <button type="button" class="close text-white" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container justify-content-center row text-center">
                                        @if ($paymentimg != null)
                                            <label>รูปภาพสลิป</label>
                                            @foreach ($slipimg as $key => $image)
                                                <div class="card col-4 mt-3 mx-2" style="width: 13rem;">
                                                    <img src="{{ $image }}" class="" alt="รูปภาพสลิป">
                                                    <input type="hidden" name="index_slip"
                                                        value="{{ $key }}" />
                                                    <div class="card-body">
                                                        <button class="btn btn-primary" type="button"
                                                            onclick="ShowImg('{{ $image }}')">
                                                            ดูรูปภาพ
                                                        </button>
                                                    </div>
                                                </div>

                                                <div id="myModalll" class="modalll">
                                                    <span class="float-end closeee">&times;</span>
                                                    <img class="modalll-content" id="slippp">
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="mt-3">
                                        <label>จำนวนผู้เข้าพัก(ผู้ใหญ่)</label>
                                        <input type="text" value="{{ $row->guest_adult }} คน" class="form-control"
                                            readonly>
                                    </div>
                                    <div class="mt-3">
                                        <label>จำนวนผู้เข้าพัก(เด็ก)</label>
                                        <input type="text" value="{{ $row->guest_child }} คน" class="form-control"
                                            readonly>
                                    </div>
                                    <div class="mt-3">
                                        <label>จำนวนห้องที่จอง</label>
                                        <input type="text" value="{{ $row->reserve_quantity }} ห้อง"
                                            class="form-control" readonly>
                                    </div>
                                    <div class="mt-3">
                                        <label>เข้าพัก</label>
                                        <input type="text" value="{{ $row->start_in_room }}" class="form-control"
                                            readonly>
                                    </div>
                                    <div class="mt-3">
                                        <label>เช็คเอ้า</label>
                                        <input type="text" value="{{ $row->end_in_room }}" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                                        data-dismiss="modal">ยกเลิก</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- payment Modal -->
                    <div wire:ignore.self class="modal fade" id="paymentreserveModal{{ $row->id }}" tabindex="-1"
                        aria-labelledby="paymentreserveModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header card-header bg-secondary border-secondary">
                                    <h5 class="modal-title" id="paymentreserveModalLabel">สถานะการชำระ</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ url('payment-reserves', $row->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mt-3">
                                            <label>สถานะการชำระ</label>
                                            <select class="form-control" name="payment_status">
                                                @if ($row->payment_status == '0')
                                                    @php
                                                        $payment = 'ยังไม่ชำระ';
                                                    @endphp
                                                @elseif($row->payment_status == '2')
                                                    @php
                                                        $payment = 'มัดจำ';
                                                    @endphp
                                                @else
                                                    @php
                                                        $payment = 'ชำระเต็ม';
                                                    @endphp
                                                @endif
                                                <option hidden selected value="{{ $row->payment_status }}">
                                                    {{ $payment }}</option>
                                                <option value="0">ยังไม่ชำระ</option>
                                                <option value="2">มัดจำ</option>
                                                <option value="1">ชำระเต็ม</option>
                                            </select>
                                        </div>
                                    </div>
                                    @if ($message = Session::get('successpayment'))
                                        <script>
                                            Swal.fire({
                                                title: 'แก้ไขสถานะการชำระสำเร็จ!',
                                                text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                                                icon: 'success'
                                            });
                                        </script>
                                    @else
                                    @endif
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">ยืนยัน</button>
                                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                                            data-dismiss="modal">ยกเลิก</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- edit Modal -->
                    <div wire:ignore.self class="modal fade" id="editreserveModal{{ $row->id }}" tabindex="-1"
                        aria-labelledby="editreserveModalLabel" aria-hidden="true">
                        <div class="modal-dialog xl-logM">
                            <div class="modal-content">
                                <div class="modal-header card-header bg-warning border-warning">
                                    <h5 class="modal-title text-white" id="editreserveModalLabel">
                                        แก้ไขข้อมูลการจอง</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                @if ($paymentimg != null)
                                    <div class="container justify-content-center row text-center">
                                        <label class="mt-3">รูปภาพสลิป</label>
                                        @foreach ($slipimg as $key => $img)
                                            <div class="card mt-3 mx-2" style="width: 13rem;">
                                                <form action="{{ url('delete_slip', $row->id) }}" method="POST">
                                                    @csrf
                                                    <img src="{{ $img }}" class="card-img-top slipimg"
                                                        alt="รูปภาพห้องพัก">
                                                    <input type="hidden" name="payment_slip"
                                                        value="{{ $payment_slip }}" />
                                                    <input type="hidden" name="index_delete"
                                                        value="{{ $key }}" />
                                                    <div class="card-body">
                                                        <button class="btn btn-danger" type="submit"
                                                            onclick="selectDeleteImg('{{ $img }}',{{ $key }})">
                                                            ลบ
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>

                                            <div id="myModalll" class="modalll">
                                                <span class="closeee">&times;</span>
                                                <img class="modalll-content" id="slippp" src="{{ $img }}">
                                                <div id="caption"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <form action="{{ url('update-reserves', $row->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="modal-body">
                                        <label class="active">เพิ่มรูปภาพสลิป</label>
                                        <input type="file" name="payment_slip[]" class="form-control"
                                            accept="image/*" multiple>

                                        <div class="mt-3">
                                            <label>เลขที่ห้องที่ต้องการจอง</label>
                                            <select class="form-control" name="room_id">
                                                <option hidden selected value="{{ $row->room_id }}">
                                                    {{ $row->room_name }}
                                                </option>
                                                @foreach ($rooms as $roomsall)
                                                    <option value="{{ $roomsall->id }}">
                                                        {{ $roomsall->room_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-3">
                                            <label>จำนวนผู้เข้าพักผู้ใหญ่</label>
                                            <input type="number" value="{{ $row->guest_adult }}" name="guest_adult"
                                                min="0" class="form-control">
                                        </div>
                                        <div class="mt-3">
                                            <label>จำนวนผู้เข้าพักเด็ก</label>
                                            <input type="number" value="{{ $row->guest_child }}" name="guest_child"
                                                min="1" class="form-control">
                                        </div>
                                        <div class="mt-3">
                                            <label>เข้าพัก</label>
                                            <input type="date" value="{{ $row->start_in_room }}" name="start_in_room"
                                                class="form-control">
                                        </div>
                                        <div class="mt-3">
                                            <label>เช็คเอ้าท์</label>
                                            <input type="date" value="{{ $row->end_in_room }}" name="end_in_room"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">ยืนยัน</button>
                                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                                            data-dismiss="modal">ยกเลิก</button>
                                    </div>
                                </form>
                            </div>
                            @if ($message = Session::get('success'))
                                <script>
                                    Swal.fire({
                                        title: 'แก้ไขข้อมูลการจองสำเร็จ!',
                                        text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                                        icon: 'success'
                                    });
                                </script>
                            @endif
                        </div>
                    </div>

                    <!-- delete modal -->
                    <div id="deletereserveModal{{ $row->id }}" class="modal fade">
                        <div class="modal-dialog modal-confirm">
                            <div class="modal-content">
                                <div class="modal-header flex-column">
                                    <div class="icon-box">
                                        <i class="material-icons">&#xE5CD;</i>
                                    </div>
                                    <h4 class="modal-title w-100">คุณแน่ใจไหม?</h4>
                                    <button type="button" class="close text-white" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                </div>
                                <form action="{{ url('delete-reserves', $row->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        <p>คุณแน่ใจไหมที่ต้องการจะลบข้อมูลนี้?</p>
                                    </div>

                                    @if ($message = Session::get('delete'))
                                        <script>
                                            Swal.fire({
                                                title: 'ทำการลบสำเร็จ!',
                                                text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                                                icon: 'success'
                                            });
                                        </script>
                                    @endif
                                    <div class="modal-footer justify-content-center">
                                        <button type="submit" class="btn btn-danger">ลบ</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">ยกเลิก</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </table>
                <div class="float-end mt-2 mr-3">
                    {!! $reserves->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="cardreserveModal" tabindex="-1" data-bs-backdrop="static"
        aria-labelledby="cardreserveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header card-header bg-purple  border-purple ">
                    <h5 class="modal-title" id="cardreserveModalLabel">
                        ฟอร์มบัตรประชาชน</h5>
                    <button type="button" onclick="closemodal()" class="close text-white" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- <form action="{{ url('smart-insert', $row->id) }}" id="formmodal" enctype="multipart/form-data"> --}}
                <form onsubmit="submitdata(event,this)" id="formmodal" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- <center><input type="button" class="btn btn-warning" value="ดึงข้อมูลจากบัตรประชาชน"
                                onclick="readdata()" id="btnnnn"></center> --}}
                                {{-- <input hidden type="text" class="form-control" id="CitizenNo" name="identity_card"
                                readonly>
                                <input hidden type="text" class="form-control" id="TitleNameTh" name="name_prefixth"
                                readonly>
                                <input hidden type="text" class="form-control" id="LastNameTh" name="last_nameth"
                                readonly>
                                <input hidden type="text" class="form-control" id="TitleNameEn" name="name_prefixen"
                                readonly>
                                <input hidden type="text" class="form-control" id="FirstNameEn" name="first_nameen"
                                readonly>
                                <input hidden type="text" class="form-control" id="LastNameEn" name="last_nameen"
                                readonly>
                                <input hidden type="text" class="form-control" id="BirthDate" name="birthdate" readonly>
                                <input hidden type="text" class="form-control" id="Gender" name="gender" readonly>
                                <input hidden type="text" class="form-control" id="HomeNo" name="inhabited" readonly>
                                <input hidden type="text" class="form-control" id="Tumbol" name="tumbol" readonly>
                                <input hidden type="text" class="form-control" id="Amphur" name="amphur" readonly>
                                <input hidden type="text" class="form-control" id="Soi" name="soi" readonly>
                                <input hidden type="text" class="form-control" id="Road" name="street" readonly>
                                <input hidden type="text" class="form-control" id="Province" name="province" readonly>
                                <textarea hidden rows="1" class="form-control" id="photo" name="image_customer" readonly></textarea> --}}
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-4 mt-2">
                                    <p>บัตรประชาชน</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="CitizenNo" name="identity_card"
                                        readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 mt-2">
                                    <p>ตัวนำหน้า(ไทย)</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="TitleNameTh" name="name_prefixth"
                                        readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 mt-2">
                                    <p>ชื่อ(ไทย)</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="FirstNameTh" name="first_nameth"
                                        readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 mt-2">
                                    <p>นามสกุล(ไทย)</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="LastNameTh" name="last_nameth"
                                        readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 mt-2">
                                    <p>ตัวนำหน้า(อังกฤษ)</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="TitleNameEn" name="name_prefixen"
                                        readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 mt-2">
                                    <p>ชื่อ(อังกฤษ)</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="FirstNameEn" name="first_nameen"
                                        readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 mt-2">
                                    <p>นามสกุล(อังกฤษ)</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="LastNameEn" name="last_nameen"
                                        readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 mt-2">
                                    <p>เกิดวันที่</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="BirthDate" name="birthdate" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 mt-2">
                                    <p>เพศ</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="Gender" name="gender" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 mt-2">
                                    <p>ที่อยู่</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="HomeNo" name="inhabited" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 mt-2">
                                    <p>ตำบล</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="Tumbol" name="tumbol" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 mt-2">
                                    <p>อำเภอ</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="Amphur" name="amphur" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 mt-2">
                                    <p>ซอย</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="Soi" name="soi" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 mt-2">
                                    <p>ถนน</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="Road" name="street" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 mt-2">
                                    <p>จังหวัด</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="Province" name="province" readonly>
                                </div>
                            </div>
                            <textarea rows="1" class="form-control" id="photo" name="image_customer" readonly></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">ยืนยัน</button>
                        <button type="button" class="btn btn-secondary" wire:click="closeModal" onclick="closemodal()"
                            data-dismiss="modal">ยกเลิก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($message = Session::get('delete'))
        <script>
            Swal.fire({
                title: 'ทำการลบสำเร็จ!',
                text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                icon: 'success'
            });
        </script>
    @endif

    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                title: 'แก้ไขข้อมูลการจองสำเร็จ!',
                text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                icon: 'success'
            });
        </script>
    @endif
@endsection

<script>
    function load_data() {
        myStopFunction();
        var jdata = null;
        $.ajax({
            url: 'https://localhost:8182/thaiid/read.jsonp?callback=callback&section1=true&section2a=true&section2c=true',
            method: 'GET',
            type: 'JSON',
            success: function(jsondata) {
                var data = jsondata.substr(13, jsondata.length - 14);
                jdata = JSON.parse(data);
                if (jdata !== null) {
                    audio.play();
                    setTimeout(function() {
                        check_data_card(jdata.CitizenNo, jdata);
                    }, 500);

                } else {
                    $.busyLoadFull("hide");
                    start_read();
                    myStopFunction();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $.busyLoadFull("hide");
                Swal.fire({
                    type: 'warning',
                    title: 'ไม่สำเร็จ',
                    text: 'ยังไม่มีการอนุญาตการอ่านบัตร!' + textStatus
                }).then((res) => {
                    start_read();
                    myStopFunction();
                });
            }
        })
    }

    function check_data_card(id_card, jdata) {

        // var day1 = $("#day_class").val();
        // var subject_id = $("#subject_id").val();

        // if (day1 !== "" && subject_id !== "" && id_card !== "") {
        var id = $('#btnnnn').attr("data-id");
        let url = '/detailreserve/{$currentURL}';
        $.ajax({
            method: "GET",
            url: url,
            data: {
                id: id

            },
            success: function(data) {
                $("#res").html(data.substr(2, data.length));
                $("#check_status").val(data.substr(1, 1));

                $("#CitizenNo").val(jdata.CitizenNo);
                $("#TitleNameTh").val(jdata.TitleNameTh);
                $("#FirstNameTh").val(jdata.FirstNameTh);
                $("#LastNameTh").val(jdata.LastNameTh);
                $("#TitleNameEn").val(jdata.TitleNameEn);
                $("#FirstNameEn").val(jdata.FirstNameEn);
                $("#LastNameEn").val(jdata.LastNameEn);
                $("#HomeNo").val(jdata.HomeNo);
                $("#Soi").val(jdata.Soi);
                $("#Tumbol").val(jdata.Tumbol);
                $("#Amphur").val(jdata.Amphur);
                $("#Road").val(jdata.Road);
                $("#Province").val(jdata.Province);
                $("#BirthDate").val(jdata.BirthDate);
                $("#Gender").val(jdata.Gender);
                var image = new Image();
                image.className = "fix_image";
                image.src = "data:image/png;base64," + jdata.Photo;
                $('#photo').html(image.src);

                // alert('Your id is =' + id);
                // check_card1(jdata);
            }
        });
        // } else {
        //     $.busyLoadFull("hide");
        //     Swal.fire({
        //         type: 'error',
        //         title: 'เตือน',
        //         text: 'กรุณาเลือกข้อมูลให้ครบถ้วน!'
        //     }).then((res) => {
        //         start_read();
        //     });
        // }

    }
    var modalid = null;

    function openmodal(id) {
        modalid = id
        $("#cardreserveModal").modal("toggle");
        start_read(modalid);

        console.log(id);
    }

    function readdata() {
        start_read(modalid);
    }

    function closemodal() {
        // $("#formmodal").reset();
        document.getElementById("formmodal").reset();
        $("#cardreserveModal").modal("toggle");
    }

    function submitdata(event, form) {
        event.preventDefault();
        const formdata = new FormData(form);
        $.ajax({
            method: "POST",
            url: '/smart-insert/' + modalid,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                // location.reload();
                Swal.fire({
                    title: 'เพิ่มข้อมูลสำเร็จ!',
                    text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                    icon: 'success',
                }).then(function() {
                    location.reload();
                });
                $("#cardreserveModal").modal("toggle");
            }
        });
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $(document).on('change', '.type_room', function() {

            var typeid = $(this).val();
            // console.log(typeid);
            var div = $(this).parent();

            var op = " ";

            var _token = $('input[name="_token"]').val();

            $.ajax({
                type: 'post',
                url: '{{ url('findselect') }}',
                data: {
                    'id': typeid,
                    '_token': _token
                },

                success: function(data) {
                    // console.log('success');

                    // console.log(data);

                    // console.log(data.length);
                    op += '<option value="0" selected disabled>กรุณาเลือกห้อง</option>';
                    for (var i = 0; i < data.length; i++) {
                        op += '<option value="' + data[i].id + '">' + data[i].
                        selectroom_id + '</option>';
                    }

                    div.find('.selectroom_id').html(" ");
                    div.find('.selectroom_id').append(op);

                    // $(.'room_id').html($selectroom);

                },
                error: function() {

                }
            })

        });

    });
</script>

<script>
    function FilterkeyWord_all_table() {

        // Count td if you want to search on all table instead of specific column

        count = $('.wrapper_all .table').children('tbody').children('tr:first-child').children('td').length;

        // Declare variables
        var input, filter, table, tr, td, i;
        input = document.getElementById("search_input_all");
        filter = input.value.toLowerCase();

        table = document.getElementById("example1");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 1; i < tr.length; i++) {

            var flag = 0;
            for (j = 0; j < count; j++) {
                td = tr[i].getElementsByTagName("td")[j];
                if (td) {
                    var td_text = td.innerHTML;
                    if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {
                        //var td_text = td.innerHTML;
                        //td.innerHTML = 'shaban';
                        flag = 1;
                    } else {

                    }
                }
            }
            if (flag == 1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
</script>
