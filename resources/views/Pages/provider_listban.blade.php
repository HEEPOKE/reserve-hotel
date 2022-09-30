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
            <div class="card-header border-info" style="background-color: #0194F3">
                <h3 class="card-title text-white">รายชื่อบัญชีที่ถูกแบน</h3>
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
                </div>

            </div>

            <table class="table table-bordered mt-3 dtr-inline" id="example1" aria-describedby="example1_info">
                <thead>
                    <tr>
                        <th class="text-center">ลำดับ</th>
                        <th class="text-center">โลโก้</th>
                        {{-- <th class="text-center">ชื่อ</th> --}}
                        <th class="text-center">อีเมล</th>
                        {{-- <th class="text-center">ชื่อบริษัท</th> --}}
                        <th class="text-center">เบอร์โทร</th>
                        <th hidden class="text-center">วันใช้งานคงเหลือ</th>
                        <th hidden class="text-center">ประเภทการใช้งาน</th>
                        <th class="text-center">สถานะการใช้งาน</th>
                        <th class="text-center" width="280px">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @if (empty($users))
                        <tr>
                            <td>
                                <center>ยังไม่มีข้อมูล</center>
                            </td>
                        </tr>
                    @else
                        @foreach ($users as $key => $row)
                            <tr>
                                <td class="text-center">{{ $key + $users->firstItem() }}</td>
                                @if ($row->company_logo == null)
                                    <td class="text-center" style="width: 10%"></td>
                                @else
                                    <td class="text-center" style="width: 10%"><img src="{{ $row->company_logo }}"
                                            height="50" width="80"></td>
                                @endif

                                {{-- <td class="text-center">{{ $row->name }}</td> --}}
                                <td class="text-center">{{ $row->email }}</td>
                                {{-- <td class="text-center">{{ $row->company_name }}</td> --}}
                                <td class="text-center">{{ $row->tel }}</td>
                                @if ($row->license_status == 'ทดลองใช้งาน')
                                    @php
                                        $date5 = date_create(date('Y-m-d'));
                                        // $date4 = date_create($row->license_expire);
                                        $date3 = new DateTime($row->license_expire);
                                        $date3->modify('+7 day');
                                        $diff = date_diff($date5, $date3);
                                    @endphp
                                    <td hidden class="text-center">{{ $diff->format('%a วัน') }}</td>
                                @elseif($row->license_status == 'รายเดือน')
                                    @php
                                        $date5 = date_create(date('Y-m-d'));
                                        // $date4 = date_create($row->license_expire);
                                        $date3 = new DateTime($row->license_expire);
                                        $date3->modify('+30 day');
                                        $diff = date_diff($date5, $date3);

                                    @endphp
                                    <td hidden class="text-center">{{ $diff->format('%a วัน') }}</td>
                                @elseif($row->license_status == 'รายปี')
                                    @php
                                        $date5 = date_create(date('Y-m-d'));
                                        // $date4 = date_create($row->license_expire);
                                        $date3 = new DateTime($row->license_expire);
                                        $date3->modify('+365 day');
                                        $diff = date_diff($date5, $date3);
                                    @endphp
                                    <td hidden class="text-center">{{ $diff->format('%a วัน') }}</td>
                                @endif
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
                                <td class="text-center">
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#viewstatusModal{{ $row->id }}"><i
                                            class="fas fa-eye"></i></button>
                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-target="#banoutproviderModal{{ $row->id }}"><i
                                            class="fa fa-ban"></i></button>
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
                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mt-1">
                                        <label>ชื่อผู้ใช้งาน</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $row->name }}" readonly>
                                    </div>
                                    <div class="mt-3">
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


                <!-- banout Modal -->
                <div id="banoutproviderModal{{ $row->id }}" class="modal fade">
                    <div class="modal-dialog modal-confirm">
                        <div class="modal-content">
                            <div class="modal-header flex-column">
                                <div class="icon-box">
                                    <i class="fa fa-info border-warning"></i>
                                </div>
                                <h4 class="modal-title w-100">คุณแน่ใจไหม?</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <form action="{{ url('banout-provider', $row->id) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="role" value="0">
                                @method('PUT')
                                <div class="modal-body">
                                    <p>คุณแน่ใจไหมที่ต้องการจะปลดแบนบัญชีนี้?</p>
                                    <label>
                                        <h3>{{ $row->email }}</h3>
                                    </label>
                                </div>
                                @php
                                    //////////////////////////////////////////
                                @endphp
                                @if ($message = Session::get('banout'))
                                    <script>
                                        Swal.fire({
                                            title: 'ทำการปลดแบนสำเร็จ!',
                                            text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                                            icon: 'success'
                                        });
                                    </script>
                                @else
                                @endif
                                @php
                                    /////////////////////////////////////////
                                @endphp
                                <div class="modal-footer justify-content-center">
                                    <button type="submit" class="btn btwarning">ยืนยัน</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif

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
