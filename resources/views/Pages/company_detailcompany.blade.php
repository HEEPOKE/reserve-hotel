@extends('adminlte::page')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')
    @php
        date_default_timezone_set('Asia/Bangkok');
        // $data2 = date("Y-m-d");
        $data2 = date('Y-m-d H:i:s');

    @endphp
    <div class="card mt-3">
        <div class="wrapper_all">
            <div class="card-header border-info bgtable">
                <h3 class="card-title text-white text-center">รายชื่อผู้ใช้งาน</h3>
                @if (Auth::user()->role == '0')
                    <button type="button" class="btn btn-success float-end mr-2" data-toggle="modal"
                        data-target="#insertproviderModal">เพิ่มพนักงาน</button>
                @endif
            </div>
            {{-- <div class="row float-start col-3">
                    <div class="">
                        <input class="form-control mt-2" type="text" id="search_input_all"
                            onkeyup="FilterkeyWord_all_table()" placeholder="ค้นหาชื่อ.." title="Type in a name">
                    </div>
                </div> --}}
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
        </div>

        @if (Auth::user()->role === '0')
            <!-- Insert Modal -->
            <div wire:ignore.self class="modal fade" id="insertproviderModal" tabindex="-1"
                aria-labelledby="insertproviderModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header card-header bg-success border-success">
                            <h5 class="modal-title" id="insertproviderModalLabel">เพิ่มพนักงาน</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('insert-employee') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @foreach ($users2 as $users2row)
                            @endforeach
                            <input type="hidden" name="renew_contract" value="{{ $users2row->renew_contract }}">
                            <input type="hidden" name="role" value="3">
                            <input type="hidden" name="license_expire" value="{{ $users2row->license_expire }}">
                            <input type="hidden" name="license_status" value="{{ $users2row->license_status }}">
                            <input type="hidden" name="company_id" value="{{ Auth::user()->company_id }}">
                            <input type="hidden" name="company_name" value="{{ $users2row->company_name }}">
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
                                    <label>เบอร์โทรศ้พท์</label>
                                    <input type="text" name="tel" OnKeyPress="return chkNumber(this)"
                                        class="form-control" value="{{ old('tel') }}" maxlength="10" required>
                                    @error('tel')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            @if ($message = Session::get('employeeinsertesuccess'))
                                <script>
                                    Swal.fire({
                                        title: 'เพิ่มพนักงานสำเร็จ!',
                                        text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                                        icon: 'success'
                                    });
                                </script>
                            @endif
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">บันทึก</button>
                                <button type="button" class="btn btn-secondary" wire:click="closeModal"
                                    data-dismiss="modal">ยกเลิก</button>
                            </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="container-fluid">
            <table class="table table-bordered mt-3 dtr-inline" id="table">
                <thead>
                    <tr>
                        <th class="text-center">ลำดับ</th>
                        <th class="text-center">โลโก้</th>
                        <th class="text-center">อีเมล</th>
                        {{-- <th class="text-center">ชื่อบริษัท</th> --}}
                        <th class="text-center">เบอร์โทร</th>
                        {{-- <th class="text-center">วันใช้งานคงเหลือ</th> --}}
                        <th hidden class="text-center">ประเภทการใช้งาน</th>
                        <th class="text-center col-2">สถานะการใช้งาน</th>
                        @if (Auth::user()->role == '0')
                            <th class="text-center col-2">การจัดการ</th>
                        @endif
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
                            <td class="text-center">{{ $row->email }}</td>
                            {{-- <td class="text-center">{{ $row->company_name }}</td> --}}
                            <td class="text-center">{{ $row->tel }}</td>
                            @if ($row->license_status == 'ทดลองใช้งาน')
                                @php
                                    $date5 = date_create(date('Y-m-d'));
                                    $date3 = new DateTime($row->license_expire);
                                    $date3->modify('+7 day');
                                    $diff = date_diff($date5, $date3);
                                @endphp
                                <td hidden class="text-center">{{ $diff->format('%a วัน') }}</td>
                            @elseif($row->license_status == 'รายเดือน')
                                @php
                                    $date5 = date_create(date('Y-m-d'));
                                    $date3 = new DateTime($row->license_expire);
                                    $date3->modify('+30 day');
                                    $diff = date_diff($date5, $date3);

                                @endphp
                                <td hidden class="text-center">{{ $diff->format('%a วัน') }}</td>
                            @elseif($row->license_status == 'รายปี')
                                @php
                                    $date5 = date_create(date('Y-m-d'));
                                    $date3 = new DateTime($row->license_expire);
                                    $date3->modify('+365 day');
                                    $diff = date_diff($date5, $date3);
                                @endphp
                                <td hidden class="text-center">{{ $diff->format('%a วัน') }}</td>
                            @endif

                            </form>
                            @if ($diff < '1')
                                <td hidden class="text-center">หมดอายุการใช้งาน</td>
                            @else
                                <td hidden class="text-center">{{ $row->license_status }}</td>
                            @endif
                            @if ($diff->format('%a') > '10')
                                <td class="text-center">
                                    {{-- <div class="sonar-wrapper"> --}}
                                    <div class="sonar-emitter">
                                        <div class="sonar-wave"></div>
                                    </div>
                                    {{-- </div> --}}
                                </td>
                            @elseif($diff->format('%a') < '10')
                                <td class="text-center">
                                    {{-- <div class="sonar-wrapper"> --}}
                                    <div class="sonar-emitter3">
                                        <div class="sonar-wave3"></div>
                                    </div>
                                    {{-- </div> --}}
                                </td>
                            @elseif($diff->format('%a') < '1')
                                <td class="text-center">
                                    {{-- <div class="sonar-wrapper"> --}}
                                    <div class="sonar-emitter2">
                                        <div class="sonar-wave2"></div>
                                    </div>
                                    {{-- </div> --}}
                                </td>
                            @endif
                            @if (Auth::user()->role == '0')
                                <td class="text-center col-2">
                                    @if (Auth::user()->role == '0')
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#viewstatusModal{{ $row->id }}"><i
                                                class="fas fa-eye"></i></button>
                                    @endif
                                    @if (Auth::user()->role == '0')
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#editcompanyModal{{ $row->id }}"><i
                                                class="fas fa-edit"></i></button>
                                    @endif
                                </td>
                            @endif
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
                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mt-1">
                                        <label>ชื่อบริษัท</label>
                                        <input type="text" name="company_name" class="form-control"
                                            value="{{ $row->company_name }}" readonly>
                                    </div>
                                    @if ($row->license_status == 'ทดลองใช้งาน')
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
                                    @endif
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
                            </form>
                        </div>
                    </div>
                </div>
                {{-- @endif --}}

                <!-- edit Modal -->
                <div wire:ignore.self class="modal fade" id="editcompanyModal{{ $row->id }}" tabindex="-1"
                    aria-labelledby="editcompanyModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header card-header bg-warning border-warning">
                                <h5 class="modal-title text-white" id="editcompanyModalLabel">แก้ไขสถานะผู้ใช้งาน</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ url('update-company', $row->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="renew_contract" value="1">
                                {{-- <input type="hidden" name="license_expire" value="{{ date("Y-m-d") }}"> --}}
                                @if ($message = Session::get('success'))
                                    <script>
                                        Swal.fire({
                                            title: 'แก้ไขข้อมูลการจองสำเร็จ!',
                                            text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                                            icon: 'success'
                                        });
                                    </script>
                                @endif
                                <div class="modal-body">
                                    <div class="mt-3">
                                        <label>โลโก้</label>
                                        <input type="file" class="form-control" value="{{ $row->company_logo }}"
                                            name="company_logo" accept="image/,.png, .jpg, .jpeg">
                                        @error('company_logo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-0">
                                        <label>อีเมล</label>
                                        <input type="email" value="{{ $row->email }}" name="email"
                                            class="form-control" required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label>ชื่อบริษัท</label>
                                        <input type="text" value="{{ $row->company_name }}" name="company_name"
                                            class="form-control" required>
                                        @error('company_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label>เบอร์โทรศ้พท์</label>
                                        <input type="text" value="{{ $row->tel }}" name="tel"
                                            OnKeyPress="return chkNumber(this)" class="form-control" maxlength="10"
                                            required>
                                        @error('tel')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label>ที่อยู่</label>
                                        <textarea rows="4" type="text" name="address" class="form-control">{{ $row->address }}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label>สถานที่ตั้ง</label>
                                        <input type="text" value="{{ $row->location }}" name="location"
                                            class="form-control">
                                        @error('location')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

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
                @endforeach
            </table>
            <div class="float-end mt-2">
                {!! $users->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
    </div>


@endsection

{{-- <script>
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
</script> --}}
