@extends('adminlte::page')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')
    @php
        date_default_timezone_set('Asia/Kolkata');
        // $data2 = date("Y-m-d");
        $data2 = date('Y-m-d H:i:s');

    @endphp
    <div class="card mt-3">
        <div class="wrapper_all">
            <div class="card-header border-info" style="background-color: #0194F3">
                <h3 class="card-title text-white">ข้อมูลผู้ใช้งาน</h3>
            </div>
            <div class="container-fluid mt-2 ">
                <div class="mt-2">
                    <div class="row float-start col-3">
                        <div class="">
                            <input class="form-control mt-2" type="text" id="search_input_all"
                                onkeyup="FilterkeyWord_all_table()" placeholder="ค้นหาชื่อ.." title="Type in a name">
                        </div>
                    </div>
                    <div class="row float-start col-1 mt-3">
                        {{-- <div class="sonar-wrapper"> --}}
                        <div class="sonar-emitter">
                            <div class="sonar-wave"></div>
                        </div>
                        {{-- </div> --}}
                    </div>
                    <div class="row float-start col-2 mt-3">
                        <p>: วันใช้งานเหลือมากกว่า 10 วัน</p>
                    </div>
                    <div class="row float-start col-1 mt-3">
                        {{-- <div class="sonar-wrapper"> --}}
                        <div class="sonar-emitter3">
                            <div class="sonar-wave3"></div>
                        </div>
                        {{-- </div> --}}
                    </div>
                    <div class="row float-start col-2 mt-3">
                        <p>: วันใช้งานเหลือน้อยกว่า 10 วัน</p>
                    </div>
                    <div class="row float-start col-1 mt-3">
                        {{-- <div class="sonar-wrapper"> --}}
                        <div class="sonar-emitter2">
                            <div class="sonar-wave2"></div>
                        </div>
                        {{-- </div> --}}
                    </div>
                    <div class="row float-start col-1 mt-3">
                        <p>: วันหมด</p>
                    </div>
                    <button type="button" class="btn btn-success float-end mr-2 mt-2" data-toggle="modal"
                        data-target="#insertproviderModal">เพิ่มผู้ใช้งาน</button>
                </div>
                {{-- <button type="button" class="btn btn-success float-end mr-2" data-toggle="modal"
                        data-target="#insertproviderModal">เพิ่มผู้ใช้งาน</button> --}}
                <!-- Insert Modal -->
                <div wire:ignore.self class="modal fade" id="insertproviderModal" tabindex="-1"
                    aria-labelledby="insertproviderModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header card-header bg-success border-success">
                                <h5 class="modal-title" id="insertproviderModalLabel">เพิ่มผู้ใช้งาน</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ url('insert-provider') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="renew_contract" value="0">
                                <input type="hidden" name="license_expire" value="{{ date('Y-m-d') }}">

                                @foreach ($companies as $row2)
                                @endforeach
                                @if (empty($row2))
                                    <input type="hidden" name="company_id" value="1">
                                @else
                                    <input type="hidden" name="company_id" value="{{ $row2->id + 1 }}">
                                @endif
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>ชื่อ</label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    </div>
                                    <div class="mb-3">
                                        <label>อีเมล</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">
                                    </div>
                                    <div class="mb-3">
                                        <label>รหัสผ่าน</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">
                                    </div>
                                    <div class="mb-3">
                                        <label>ยืนยันรหัสผ่าน</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>

                                    <div class="mt-3">
                                        <label>ชื่อที่พัก</label>
                                        <input type="text" name="company_name" class="form-control" required>
                                        @error('company_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label>เบอร์โทรศ้พท์</label>
                                        <input type="text" name="tel" OnKeyPress="return chkNumber(this)"
                                            class="form-control" maxlength="10" required>
                                        @error('tel')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label>สถานะการใช้งาน</label>
                                        <select class="form-control" name="license_status">
                                            <option hidden selected>
                                                <-- กรุณาเลือก -->
                                            </option>
                                            <option value="ทดลองใช้งาน">ทดลองใช้งาน</option>
                                            <option value="รายเดือน">รายเดือน</option>
                                            <option value="รายปี">รายปี</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">บันทึก</button>
                                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                                        data-dismiss="modal">ยกเลิก</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>


            <table class="table table-bordered mt-3 dtr-inline" id="example1" aria-describedby="example1_info">
                <thead>
                    <tr>
                        <th class="text-center">ลำดับ</th>
                        <th class="text-center">โลโก้</th>
                        {{-- <th class="text-center">ชื่อ</th> --}}
                        <th class="text-center">ชื่อบริษัท</th>
                        <th class="text-center">อีเมล</th>
                        <th class="text-center">เบอร์โทร</th>
                        <th class="text-center">วันใช้งานคงเหลือ</th>
                        <th class="text-center">ประเภทการใช้งาน</th>
                        <th class="text-center">สถานะการใช้งาน</th>
                        <th class="text-center" width="280px">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $row)
                        <tr>
                            <td class="text-center">{{ $key + $users->firstItem() }}</td>
                            @if ($row->company_logo == null)
                                <td class="text-center" style="width: 10%"></td>
                            @else
                                <td class="text-center" style="width: 10%"><img src="{{ $row->company_logo }}"
                                        height="50" width="80"></td>
                            @endif
                            <td class="text-center">{{ $row->company_name }}</td>
                            <td class="text-center">{{ $row->email }}</td>
                            <td class="text-center">{{ $row->tel }}</td>

                            @if ($row->renew_contract != '0')
                                @if ($row->license_status == 'ทดลองใช้งาน')
                                    @php
                                        $date5 = date_create($row->license_expire);
                                        // $date4 = date_create($row->license_expire);
                                        $date3 = new DateTime($row->license_expire);
                                        $date3->modify('+7 day');
                                        $diff = date_diff($date5, $date3);
                                    @endphp
                                    {{-- <td class="text-center">{{ $diffall->format('%a วัน') }}</td> --}}
                                    <td class="text-center">{{ $diff->format('%a วัน') }}</td>
                                    @if ($diff->format('%a') < '1')
                                        <td class="text-center">หมดอายุการใช้งาน</td>
                                    @else
                                        <td class="text-center">{{ $row->license_status }}</td>
                                    @endif
                                @elseif($row->license_status == 'รายเดือน')
                                    @php
                                        $date5 = date_create($row->license_expire);
                                        // $date4 = date_create($row->license_expire);
                                        $date3 = new DateTime($row->license_expire);
                                        $date3->modify('+30 day');
                                        $diff = date_diff($date5, $date3);
                                    @endphp
                                    {{-- <td class="text-center">{{ $diff->format('%a วัน') }}</td> --}}
                                    <td class="text-center">{{ $diff->format('%a วัน') }}</td>
                                    @if ($diff->format('%a') < '1')
                                        <td class="text-center">หมดอายุการใช้งาน</td>
                                    @else
                                        <td class="text-center">{{ $row->license_status }}</td>
                                    @endif
                                @elseif($row->license_status == 'รายปี')
                                    @php
                                        $date5 = date_create($row->license_expire);
                                        // $date4 = date_create($row->license_expire);
                                        $date3 = new DateTime($row->license_expire);
                                        $date3->modify('+365 day');
                                        $diff = date_diff($date5, $date3);
                                    @endphp
                                    {{-- <td class="text-center">{{ $diff->format('%a วัน') }}</td> --}}
                                    <td class="text-center">{{ $diff->format('%a วัน') }}</td>
                                    @if ($diff->format('%a') < '1')
                                        <td class="text-center">หมดอายุการใช้งาน</td>
                                    @else
                                        <td class="text-center">{{ $row->license_status }}</td>
                                    @endif
                                @endif
                            @else
                                <!--- else --->
                                @if ($row->license_status == 'ทดลองใช้งาน')
                                    @php
                                        $date5 = date_create(date('Y-m-d'));
                                        // $date4 = date_create($row->license_expire);
                                        $date3 = new DateTime($row->license_expire);
                                        $date3->modify('+7 day');
                                        $diff = date_diff($date5, $date3);
                                    @endphp
                                    <td class="text-center">{{ $diff->format('%a วัน') }}</td>
                                    @if ($diff->format('%a') < '1')
                                        <td class="text-center">หมดอายุการใช้งาน</td>
                                    @else
                                        <td class="text-center">{{ $row->license_status }}</td>
                                    @endif
                                @elseif($row->license_status == 'รายเดือน')
                                    @php
                                        $date5 = date_create(date('Y-m-d'));
                                        // $date4 = date_create($row->license_expire);
                                        $date3 = new DateTime($row->license_expire);
                                        $date3->modify('+30 day');
                                        $diff = date_diff($date5, $date3);

                                    @endphp
                                    <td class="text-center">{{ $diff->format('%a วัน') }}</td>
                                    @if ($diff->format('%a') < '1')
                                        <td class="text-center">หมดอายุการใช้งาน</td>
                                    @else
                                        <td class="text-center">{{ $row->license_status }}</td>
                                    @endif
                                @elseif($row->license_status == 'รายปี')
                                    @php
                                        $date5 = date_create(date('Y-m-d'));
                                        // $date4 = date_create($row->license_expire);
                                        $date3 = new DateTime($row->license_expire);
                                        $date3->modify('+365 day');
                                        $diff = date_diff($date5, $date3);
                                    @endphp
                                    <td class="text-center">{{ $diff->format('%a วัน') }}</td>
                                    @if ($diff->format('%a') < '1')
                                        <td class="text-center">หมดอายุการใช้งาน</td>
                                    @else
                                        <td class="text-center">{{ $row->license_status }}</td>
                                    @endif
                                @endif
                            @endif

                            {{-- @if ($row->license_status == 'ทดลองใช้งาน')
                                    @php
                                        $date5 = date_create(date('Y-m-d'));
                                        // $date4 = date_create($row->license_expire);
                                        $date3 = new DateTime($row->license_expire);
                                        $date3->modify('+7 day');
                                        $diff = date_diff($date5, $date3);
                                    @endphp
                                    <td class="text-center">{{ $diff->format('%a วัน') }}</td>
                                @elseif($row->license_status == 'รายเดือน')
                                    @php
                                        $date5 = date_create(date('Y-m-d'));
                                        // $date4 = date_create($row->license_expire);
                                        $date3 = new DateTime($row->license_expire);
                                        $date3->modify('+30 day');
                                        $diff = date_diff($date5, $date3);

                                    @endphp
                                    <td class="text-center">{{ $diff->format('%a วัน') }}</td>
                                @elseif($row->license_status == 'รายปี')
                                    @php
                                        $date5 = date_create(date('Y-m-d'));
                                        // $date4 = date_create($row->license_expire);
                                        $date3 = new DateTime($row->license_expire);
                                        $date3->modify('+365 day');
                                        $diff = date_diff($date5, $date3);
                                    @endphp
                                    <td class="text-center">{{ $diff->format('%a วัน') }}</td>
                                @endif --}}



                            {{-- @if ($diff->format('%a') < '1')
                                <td class="text-center">หมดอายุการใช้งาน</td>
                            @else
                                <td class="text-center">{{ $row->license_status }}</td>
                            @endif --}}
                            @if ($diff->format('%a') > '10')
                                <td class="text-center">

                                    <div class="sonar-emitter">
                                        <div class="sonar-wave"></div>
                                    </div>

                                </td>
                            @elseif($diff->format('%a') < '10')
                                <td class="text-center">

                                    <div class="sonar-emitter3">
                                        <div class="sonar-wave3"></div>
                                    </div>

                                </td>
                            @elseif($diff->format('%a') < '1')
                                <td class="text-center">

                                    <div class="sonar-emitter2">
                                        <div class="sonar-wave2"></div>
                                    </div>

                                </td>
                            @endif

                            <td class="text-center">
                                <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#viewstatusModal{{ $row->id }}"><i class="fas fa-eye"></i></button>
                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="#editstatusproviderModal{{ $row->id }}"><i
                                        class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#banproviderModal{{ $row->id }}"><i class="fa fa-ban"></i></button>
                            </td>
                        </tr>
                </tbody>


                <!-- view Modal -->
                <div wire:ignore.self class="modal fade" id="viewstatusModal{{ $row->id }}" tabindex="-1"
                    aria-labelledby="viewstatusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header card-header bg-primary border-primary">
                                <h5 class="modal-title" id="viewstatusModalLabel">ดูรายละเอียดผู้ประกอบการ</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mt-1">
                                    <label>ชื่อผู้ใช้งาน</label>
                                    <input type="text" class="form-control" value="{{ $row->name }}" readonly>
                                </div>
                                {{-- <div class="mt-3">
                                        <label>ชื่อบริษัท</label>
                                        <input type="text" name="company_name" class="form-control"
                                            value="{{ $row->company_name }}" readonly>
                                    </div> --}}
                                {{-- @if ($row->license_status == 'ทดลองใช้งาน')
                                        @php
                                            $date5 = date_create(date('Y-m-d'));
                                            $date3 = new DateTime($row->license_expire);
                                            $date3->modify('+7 day');
                                            $diff = date_diff($date5, $date3);

                                        @endphp
                                        @if ($diff->format('%a วัน') < '1')
                                            <div class="mt-3">
                                                <label>วันใช้งานคงเหลือ</label>
                                                <input type="text" name="license_expire" class="form-control"
                                                    value="0" readonly>
                                            </div>
                                        @else
                                            <div class="mt-3">
                                                <label>วันใช้งานคงเหลือ</label>
                                                <input type="text" name="license_expire" class="form-control"
                                                    value="{{ $diff->format('%a วัน') }}" readonly>
                                            </div>
                                        @endif
                                    @elseif($row->license_status == 'รายเดือน')
                                        @php
                                            $date5 = date_create(date('Y-m-d'));
                                            $date3 = new DateTime($row->license_expire);
                                            $date3->modify('+30 day');
                                            $diff = date_diff($date5, $date3);
                                        @endphp
                                        @if ($diff->format('%a วัน') < '1')
                                            <div class="mt-3">
                                                <label>วันใช้งานคงเหลือ</label>
                                                <input type="text" name="license_expire" class="form-control"
                                                    value="0" readonly>
                                            </div>
                                        @else
                                            <div class="mt-3">
                                                <label>วันใช้งานคงเหลือ</label>
                                                <input type="text" name="license_expire" class="form-control"
                                                    value="{{ $diff->format('%a วัน') }}" readonly>
                                            </div>
                                        @endif
                                    @elseif($row->license_status == 'รายปี')
                                        @php
                                            $date5 = date_create(date('Y-m-d'));
                                            $date3 = new DateTime($row->license_expire);
                                            $date3->modify('+365 day');
                                            $diff = date_diff($date5, $date3);
                                        @endphp
                                        @if ($diff->format('%a วัน') < '1')
                                            <div class="mt-3">
                                                <label>วันใช้งานคงเหลือ</label>
                                                <input type="text" name="license_expire" class="form-control"
                                                    value="0" readonly>
                                            </div>
                                        @else
                                            <div class="mt-3">
                                                <label>วันใช้งานคงเหลือ</label>
                                                <input type="text" name="license_expire" class="form-control"
                                                    value="{{ $diff->format('%a วัน') }}" readonly>
                                            </div>
                                        @endif
                                    @endif
                                    @if ($diff < '1')
                                        <div class="mt-3">
                                            <label>ประเภทการใช้งาน</label>
                                            <input type="text" name="license_status" class="form-control"
                                                value="หมดอายุการใช้งาน" readonly>
                                        </div>
                                    @else
                                        <div class="mt-3">
                                            <label>ประเภทการใช้งาน</label>
                                            <input type="text" name="license_status" class="form-control"
                                                value="{{ $row->license_status }}" readonly>
                                        </div>
                                    @endif --}}
                                <div class="mt-3">
                                    <label>ที่อยู่</label>
                                    <textarea rows="4" type="text" name="address" class="form-control" readonly>{{ $row->address }}</textarea>
                                </div>
                                <div class="mt-3">
                                    <label>สถานที่ตั้ง</label>
                                    <div class="form-group row">
                                        <div class="col-10">
                                            <input class="form-control" name="location" type="text"
                                                value="{{ $row->location }}" readonly>
                                        </div>
                                        <div class="col-xs-2">
                                            <button class="btn btn-primary mt-2" type="button"><a
                                                    href="{{ $row->location }}"class="text-white">คลิกลิ้ง</a></button>
                                        </div>
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




                <!-- edit Modal -->
                <div wire:ignore.self class="modal fade" id="editproviderModal{{ $row->id }}" tabindex="-1"
                    aria-labelledby="editproviderModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header card-header bg-warning border-warning">
                                <h5 class="modal-title text-white" id="editproviderModalLabel">แก้ไขสถานะผู้ใช้งาน</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ url('update-provider', $row->id) }}" enctype="multipart/form-data">
                                @csrf
                                {{-- <input type="hidden" name="renew_contract" value="1"> --}}
                                {{-- <input type="hidden" name="license_expire" value="{{ date('Y-m-d') }}"> --}}
                                {{-- @method('PUT') --}}

                                <div class="modal-body">

                                    {{-- <div class="mt-0">
                                        <label>สถานะการใช้งาน</label>
                                        <select class="form-control" name="license_status">
                                            <option hidden selected value="{{ $row->license_status }}">
                                                {{ $row->license_status }}</option>
                                            <option value="ทดลองใช้งาน">ทดลองใช้งาน</option>
                                            <option value="รายเดือน">
                                                รายเดือน</option>
                                            <option value="รายปี">
                                                รายปี</option>
                                        </select>
                                    </div> --}}
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">บันทึก</button>
                                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                                        data-dismiss="modal">ยกเลิก</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- editstatus Modal -->
                <div wire:ignore.self class="modal fade" id="editstatusproviderModal{{ $row->id }}" tabindex="-1"
                    aria-labelledby="editstatusproviderModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header card-header bg-warning border-warning">
                                <h5 class="modal-title text-white" id="editstatusproviderModalLabel">แก้ไขสถานะผู้ใช้งาน
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ url('updatestatus-provider', $row->id) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="renew_contract" value="1">
                                <input type="hidden" name="license_expire" value="{{ date('Y-m-d') }}">
                                {{-- @method('PUT') --}}

                                <div class="modal-body">

                                    <div class="mt-0">
                                        <label>สถานะการใช้งาน</label>
                                        {{-- <select onchange="selectmonthall(this);" class="form-control"
                                            name="license_status"> --}}
                                        <select class="form-control"
                                            name="license_status">
                                            <option hidden selected value="{{ $row->license_status }}">
                                                {{ $row->license_status }}</option>
                                            <option value="ทดลองใช้งาน">ทดลองใช้งาน</option>
                                            <option value="รายเดือน">
                                                รายเดือน</option>
                                            <option value="รายปี">
                                                รายปี</option>
                                        </select>
                                    </div>
                                    {{-- <div class="mt-2">
                                        <div id="mothselect" style="display: none;">
                                            <select name="license_status" class="form-control">
                                                <option hidden value=""><-- กรุณาเลือก --></option>
                                                <option value="1">1 เดือน</option>
                                                <option value="2">2 เดือน</option>
                                                <option value="4">4 เดือน</option>
                                                <option value="5">5 เดือน</option>
                                                <option value="6">6 เดือน</option>
                                                <option value="7">7 เดือน</option>
                                                <option value="8">8 เดือน</option>
                                                <option value="9">9 เดือน</option>
                                                <option value="10">10 เดือน</option>
                                                <option value="11">11 เดือน</option>
                                                <option value="12">12 เดือน</option>
                                            </select>
                                    </div>  --}}
                                </div>
                                    <div class="modal-footer mt-3">
                                        <button type="submit" class="btn btn-success">บันทึก</button>
                                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                                            data-dismiss="modal">ยกเลิก</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- ban Modal -->
                <div id="banproviderModal{{ $row->id }}" class="modal fade">
                    <div class="modal-dialog modal-confirm">
                        <div class="modal-content">
                            <div class="modal-header flex-column">
                                <div class="icon-box">
                                    <i class="material-icons">&#xE5CD;</i>
                                </div>
                                <h4 class="modal-title w-100">คุณแน่ใจไหม?</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <form action="{{ url('ban-provider', $row->id) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="role" value="5">
                                {{-- @method('PUT') --}}
                                <div class="modal-body">
                                    <p>คุณแน่ใจไหมที่ต้องการจะแบนบัญชีนี้?</p>
                                    <label>
                                        <h3>{{ $row->email }}</h3>
                                    </label>
                                </div>
                                @if ($message = Session::get('bansuccess'))
                                    <script>
                                        Swal.fire({
                                            title: 'ทำการแบนสำเร็จ!',
                                            text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                                            icon: 'success'
                                        });
                                    </script>
                                @else
                                @endif
                                <div class="modal-footer justify-content-center">
                                    <button type="submit" class="btn btn-danger">ยืนยัน</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </table>
            {!! $users->links('pagination::bootstrap-4') !!}
        </div>
    </div>
    </div>
    </div>
    @if ($message = Session::get('statusemployee'))
        <script>
            Swal.fire({
                title: 'เพิ่มพนักงานสำเร็จ!',
                text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                icon: 'success'
            });
        </script>
    @endif
    @if ($message = Session::get('status'))
        <script>
            Swal.fire({
                title: 'เพิ่มผู้ใช้งานสำเร็จ!',
                text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                icon: 'success'
            });
        </script>
    @endif
    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                title: 'แก้ไขสถานะสำเร็จ!',
                text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                icon: 'success'
            });
        </script>
    @endif
@endsection

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

{{-- <script type="text/javascript">
    function selectmonthall(that) {
        if (that.value == "รายเดือน") {
            document.getElementById("mothselect").style.display = "block";
        } else {
            document.getElementById("mothselect").style.display = "none";
        }
    }
</script> --}}
