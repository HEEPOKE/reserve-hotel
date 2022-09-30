@extends('adminlte::page')
@section('content')
    @php
        $num = 1;
    @endphp
    <div class="card mt-3">
        <div class="wrapper_all">
            <div class="card-header border-info bgtable">
                <h3 class="card-title text-white">ข้อมูลห้องพัก</h3>
            </div>
            <div class="container-fluid mt-2">
                <div class="row">
                    {{-- <div class="row col-3">
                        <div class="">
                            <input class="form-control" type="text" id="search_input_all"
                                onkeyup="FilterkeyWord_all_table()" placeholder="ค้นหาชื่อ.." title="Type in a name">
                        </div>
                    </div> --}}
                    <div>

                    </div>
                </div>
                <table class="table table-bordered border-dark mt-3 text-center dtr-inline" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">ลำดับ</th>
                            <th class="text-center">ชื่อห้อง</th>
                            <th class="text-center">ประเภทห้อง</th>
                            <th class="text-center">จำนวนคนที่รองรับ</th>
                            <th class="text-center">จำนวนห้องพัก</th>
                            <th class="text-center">ราคา</th>
                            <th class="text-center col-2">จัดการห้องพัก</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $key => $row)
                            <tr>
                                <td class="text-center">{{ $key + $rooms->firstItem() }}</td>
                                <td class="text-center">{{ $row->room_name }}</td>
                                <td class="text-center">{{ $row->room_type }}</td>
                                <td class="text-center">{{ $row->room_capacity }}</td>
                                <td class="text-center">{{ $row->room_quantity }}</td>
                                <td class="text-center">{{ $row->price }}</td>
                                <td class="text-center col-2">
                                    <a type="button" class="btn btn-info" href="{{ url('detailroom', $row->id) }}"><i
                                            class="fas fa-eye"></i></a>
                                    <a type="button" href="{{ url('editroom', $row->id) }}" class="btn btn-warning"><i
                                            class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="float-end mt-2 mx-3">
                {!! $rooms->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
    </div>
    @if ($message = Session::get('status'))
        <script>
            Swal.fire({
                title: 'เพิ่มข้อมูลห้องพักสำเร็จ!',
                text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                icon: 'success'
            });
        </script>
    @endif
    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                title: 'แก้ไขข้อมูลห้องพักสำเร็จ!',
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

        table = document.getElementById("table-room");
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
