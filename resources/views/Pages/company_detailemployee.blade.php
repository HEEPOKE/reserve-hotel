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
            <div class="card-header border-info bgtable">
                <h3 class="card-title text-white">รายชื่อพนักงาน</h3>
            </div>
            {{-- <div class="mt-2">
                <div class="row float-start col-3">
                    <div class="">
                        <input class="form-control" type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()"
                            placeholder="ค้นหาชื่อ.." title="Type in a name">
                    </div>
                </div>
            </div> --}}

            <div class="container-fluid mt-2">
                <div class="row">
                    <div>

                    </div>
                </div>
                <table class="table table-bordered dtr-inline" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">ลำดับ</th>
                            <th class="text-center">ชื่อพนักงาน</th>
                            <th class="text-center">อีเมล</th>
                            <th class="text-center">เบอร์</th>
                            <th class="text-center col-2">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $row)
                            <tr>
                                <td class="text-center">{{ $key + $users->firstItem() }}</td>
                                <td class="text-center">{{ $row->name }}</td>
                                <td class="text-center">{{ $row->email }}</td>
                                <td class="text-center">{{ $row->tel }}</td>
                                <td class="text-center col-2">
                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-target="#editcompanyModal{{ $row->id }}"><i
                                            class="fas fa-edit"></i></button>
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

                                        <div class="">
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
                                    <h5 class="modal-title text-white" id="editcompanyModalLabel">แก้ไขรายละเอียดพนักงาน
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ url('update-employee', $row->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    {{-- <input type="hidden" name="renew_contract" value="1"> --}}
                                    {{-- <input type="hidden" name="license_expire" value="{{ date("Y-m-d") }}"> --}}
                                    @if ($message = Session::get('success'))
                                        <script>
                                            Swal.fire({
                                                title: 'แก้ไขrพนักงานสำเร็จ!',
                                                text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                                                icon: 'success'
                                            });
                                        </script>
                                    @endif
                                    <div class="modal-body">
                                        <div class="mt-0">
                                            <label>ชื่อ</label>
                                            <input type="name" value="{{ $row->name }}" name="name"
                                                class="form-control" required>
                                            @error('name')
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
                                            <label>เบอร์โทรศ้พท์</label>
                                            <input type="text" value="{{ $row->tel }}" name="tel"
                                                OnKeyPress="return chkNumber(this)" class="form-control" maxlength="10"
                                                required>
                                            @error('tel')
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
                <div class="float-end mt-2 mr-3">
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
</script> --}}
