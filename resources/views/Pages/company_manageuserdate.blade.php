@extends('adminlte::page')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#selectcheck,#selectreserve").on("change", function() {
            var checkall = $('#selectcheck').find("option:selected").val();
            var reserveall = $('#selectreserve').find("option:selected").val();
            SearchData(checkall, reserveall)
        });
    });

    function SearchData(checkall, reserveall) {
        if (checkall.toUpperCase() == 'ALL' && reserveall.toUpperCase() == 'ALL') {
            $('#example1 tbody tr').show();
        } else {
            $('#example1 tbody tr:has(td)').each(function() {
                var rowCheck = $.trim($(this).find('td:eq(0)').text());
                var rowReserve = $.trim($(this).find('td:eq(1)').text());
                if (checkall.toUpperCase() != 'ALL' && reserveall.toUpperCase() != 'ALL') {
                    if (rowCheck.toUpperCase() == checkall.toUpperCase() && rowReserve == reserveall) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                } else if ($(this).find('td:eq(0)').text() != '' || $(this).find('td:eq(0)').text() != '') {
                    if (checkall != 'all') {
                        if (rowCheck.toUpperCase() == checkall.toUpperCase()) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    }
                    if (reserveall != 'all') {
                        if (rowReserve == reserveall) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    }
                }

            });
        }
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#selectchec2,#selectreserve2").on("change", function() {
            var checkall = $('#selectchec2').find("option:selected").val();
            var reserveall = $('#selectreserve2').find("option:selected").val();
            SearchDat2(checkall, reserveall)
        });
    });

    function SearchDat2(checkall, reserveall) {
        if (checkall.toUpperCase() == 'ALL' && reserveall.toUpperCase() == 'ALL') {
            $('#example2 tbody tr').show();
        } else {
            $('#example2 tbody tr:has(td)').each(function() {
                var rowCheck = $.trim($(this).find('td:eq(0)').text());
                var rowReserve = $.trim($(this).find('td:eq(1)').text());
                if (checkall.toUpperCase() != 'ALL' && reserveall.toUpperCase() != 'ALL') {
                    if (rowCheck.toUpperCase() == checkall.toUpperCase() && rowReserve == reserveall) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                } else if ($(this).find('td:eq(0)').text() != '' || $(this).find('td:eq(0)').text() != '') {
                    if (checkall != 'all') {
                        if (rowCheck.toUpperCase() == checkall.toUpperCase()) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    }
                    if (reserveall != 'all') {
                        if (rowReserve == reserveall) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    }
                }

            });
        }
    }
</script>
@section('content')
    <div class="card mt-3">
        <div class="card-header border-info" style="background-color: #0194F3">
            <h3 class="card-title text-white">รายชื่อลูกค้าที่จองออนไลน์</h3>
        </div>
        <div class="container-fluid mt-2">
            <div class="row">
                <form action="{{ url('manageuserdate') }}" method="POST" enctype="multipart/form-data">
                    <div class="row input-daterange">
                        <div class="col-md-4">
                            <input type="date" id="fromdate"
                                {{-- value="@php if(isset($_GET['start_in_room'])){ echo $_GET['start_in_room']; } @endphp" --}}
                                class="form-control" />
                        </div>
                        <div class="col-md-4">
                            <input type="date" id="toDate"
                                {{-- value="@php if(isset($_GET['end_in_room'])){ echo $_GET['end_in_room']; } @endphp" --}}
                                class="form-control" />
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            {{-- <input type="button" name="filter" id="filter" value="Filter"
                            class="btn btn-primary"> --}}
                            {{-- <button type="submit" name="refresh" id="refresh" class="btn btn-primary">Refresh</button> --}}
                        </div>
                    </div>
                </form>

                <div class="container mt-4 mb-2">
                    <div class="row float-start col-8">
                        <div class="btn-group">
                            <select style="width: 15%;" class="cl_age" id="selectreserve">
                                <option value="all">ทั้งหมด</option>
                                @foreach ($customers3 as $customersal3)
                                    @if ($customersal3->check_report == '0')
                                        <option value="{{ $customersal3->check_report }}">
                                            รอเช็คอิน
                                        </option>
                                    @elseif($customersal3->check_report == '1')
                                        <option value="{{ $customersal3->check_report }}">
                                            เช็คอิน
                                        </option>
                                    @elseif($customersal3->check_report == '2')
                                        <option value="{{ $customersal3->check_report }}">
                                            เช็คเอ้าท์
                                        </option>
                                    @endif
                                    {{-- <option value="{{ $customersall->check_report }}">
                                    {{ $customersall->check_report }}
                                </option> --}}
                                @endforeach
                            </select>
                            <select style="width: 15%;" class="selectcheck" id="selectcheck">
                                <option value="all">ทั้งหมด</option>
                                @foreach ($customers2 as $customersall2)
                                    <option value="{{ $customersall2->type_report }}">
                                        {{ $customersall2->type_report }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row float-end col-3">
                        <div class="">
                            <input class="form-control" type="text" id="myInput" onkeyup="myFunction()"
                                placeholder="ค้นหาชื่อ.." title="Type in a name">
                        </div>
                    </div>
                </div>
            </div>

            @php $i=1; @endphp
            <table class="table table-bordered dtr-inline" id="example1" aria-describedby="example1_info">
                <thead>
                    <tr>
                        <th style="display:none;"></th>
                        <th style="display:none;"></th>
                        <th class="text-center">ลำดับ</th>
                        <th class="text-center">ห้องพัก</th>
                        <th class="text-center">ชื่อ-นามสกุล</th>
                        <th class="text-center">เบอร์โทร</th>
                        <th class="text-center">วันที่เช็คอิน</th>
                        <th class="text-center">วันที่เช็คเอ้าท์</th>
                        <th class="text-center">อีเมล์</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $fromdate = $_GET['fromdate'];
                        $toDate = $_GET['to_date'];
                    @endphp
                    {{-- @if (isset($_GET['start_in_room'] == ''))
                        @php
                            $customersfilter2 = Reserve::orderBy('reserves.id', 'desc')
                                ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                                ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'customers.id')
                                ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
                                ->where('checkin_checkouts.walk_in_customers', '0')
                                ->where('reserves.company_id', auth()->user()->company_id)
                                ->whereDate('reserves.start_in_room', '<=', $fromdate)
                                ->whereDate('reserves.end_in_room', '>=', $toDate)
                                // ->where('reserves.start_in_room')
                                ->get();
                        @endphp
                        @foreach ($customers as $row)
                            <tr>
                                <td style="display:none;">{{ $row->room_type }}</td>
                                <td style="display:none;">{{ $row->stay_status }}</td>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="text-center">{{ $row->room_name }}</td>
                                <td class="text-center">{{ $row->first_name }} {{ $row->last_name }}</td>
                                <td class="text-center">{{ $row->tel }}</td>
                                <td class="text-center">{{ $row->start_in_room }}</td>
                                <td class="text-center">{{ $row->end_in_room }}</td>
                                <td class="text-center">{{ $row->email }}</td>
                            </tr>
                        @endforeach
                    @else
                        @foreach ($customersfilter2 as $rowfi)
                            <tr>
                                <td style="display:none;">{{ $rowfi->room_type }}</td>
                                <td style="display:none;">{{ $rowfi->stay_status }}</td>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="text-center">{{ $rowfi->room_name }}</td>
                                <td class="text-center">{{ $rowfi->first_name }} {{ $rowfi->last_name }}</td>
                                <td class="text-center">{{ $rowfi->tel }}</td>
                                <td class="text-center">{{ $rowfi->start_in_room }}</td>
                                <td class="text-center">{{ $rowfi->end_in_room }}</td>
                                <td class="text-center">{{ $rowfi->email }}</td>
                            </tr>
                        @endforeach
                    @endif --}}

                    @foreach ($customers as $row)
                        <tr>
                            <td style="display:none;">{{ $row->room_type }}</td>
                            <td style="display:none;">{{ $row->stay_status }}</td>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center">{{ $row->room_name }}</td>
                            <td class="text-center">{{ $row->first_name }} {{ $row->last_name }}</td>
                            <td class="text-center">{{ $row->tel }}</td>
                            <td class="text-center">{{ $row->start_in_room }}</td>
                            <td class="text-center">{{ $row->end_in_room }}</td>
                            <td class="text-center">{{ $row->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $customers->links('pagination::bootstrap-4') !!}
        </div>
    </div>

    <div class="col-sm-6">
        <br>
    </div>
    <div class="card">
        <div class="card-header border-info" style="background-color: #0194F3">
            <h3 class="card-title text-white">รายชื่อลูกค้าที่วอร์คอิน</h3>
        </div>
        <div class="container-fluid mt-2">
            <div class="row">
                <div class="container mt-4 mb-2">
                    <div class="row float-start col-8">
                        <div class="btn-group">
                            <select style="width: 15%;" class="selectreserve2" id="selectreserve2">
                                <option value="all">ทั้งหมด</option>
                                @foreach ($customers3 as $customersal3)
                                    @if ($customersal3->check_report == '0')
                                        <option value="{{ $customersal3->check_report }}">
                                            รอเช็คอิน
                                        </option>
                                    @elseif($customersal3->check_report == '1')
                                        <option value="{{ $customersal3->check_report }}">
                                            เช็คอิน
                                        </option>
                                    @elseif($customersal3->check_report == '2')
                                        <option value="{{ $customersal3->check_report }}">
                                            เช็คเอ้าท์
                                        </option>
                                    @endif
                                    {{-- <option value="{{ $customersall->check_report }}">
                                    {{ $customersall->check_report }}
                                </option> --}}
                                @endforeach
                            </select>
                            <select style="width: 15%;" class="selectchec2" id="selectchec2">
                                <option value="all">ทั้งหมด</option>
                                @foreach ($customers2 as $customersall2)
                                    <option value="{{ $customersall2->type_report }}">
                                        {{ $customersall2->type_report }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- <select class="form-control col-3" name="status" id="status" onchange="location = this.value;">
                            <option hidden selected value="">
                                <--กรุณาเลือก-->
                            </option>
                            <option value="{{ url('manageuser') }}">จอง</option>
                            <option value="{{ url('manageusercheckin') }}">เข้าพัก</option>
                            <option value="{{ url('manageusercheckout') }}">เช็คเอ้าท์</option>
                        </select>
                        <select class="form-control mx-2 col-3" name="reporttypeSelect" id="reporttypeSelect"></select> --}}
                        </div>
                    </div>

                    <div class="row float-end col-3">
                        <div class="">
                            <input class="form-control" type="text" id="myInput2" onkeyup="myFunction2()"
                                placeholder="ค้นหาชื่อ.." title="Type in a name">
                        </div>
                    </div>
                </div>
            </div>



            @php $i=1; @endphp
            <table class="table table-bordered dtr-inline" id="example2" aria-describedby="example2_info">
                <thead>
                    <tr>
                        <th style="display:none;"></th>
                        <th style="display:none;"></th>
                        <th class="text-center">ลำดับ</th>
                        <th class="text-center">ห้องพัก</th>
                        <th class="text-center">ชื่อ-นามสกุล</th>
                        <th class="text-center">เบอร์โทร</th>
                        <th class="text-center">วันที่เช็คอิน</th>
                        <th class="text-center">วันที่เช็คเอ้าท์</th>
                        <th class="text-center">อีเมล์</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers4 as $row)
                        <tr>
                            <td style="display:none;">{{ $row->room_type }}</td>
                            <td style="display:none;">{{ $row->stay_status }}</td>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center">{{ $row->room_name }}</td>
                            <td class="text-center">{{ $row->first_name }} {{ $row->last_name }}</td>
                            <td class="text-center">{{ $row->tel }}</td>
                            <td class="text-center">{{ $row->start_in_room }}</td>
                            <td class="text-center">{{ $row->end_in_room }}</td>
                            <td class="text-center">{{ $row->email }}</td>

                        </tr>
                </tbody>
                @endforeach
            </table>
            {!! $customers4->links('pagination::bootstrap-4') !!}
        </div>
    </div>

    </div>
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("example1");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[4];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    <script>
        function myFunction2() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput2");
            filter = input.value.toUpperCase();
            table = document.getElementById("example2");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[4];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>


    <script></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    {{-- <script>
        $(document).ready(function() {
            $.datepicker.setDefaults({
                dateFormat: 'yy-mm-dd'
            });
            $(function() {
                $("#fromdate").datepicker();
                $("#toDate").datepicker();
            });
            $('#filter').click(function() {
                var fromdate = $('#fromdate').val();
                var toDate = $('#toDate').val();
                if (fromdate != '' && toDate != '') {
                    $.ajax({
                        url: "home.blade.php",
                        method: "POST",
                        data: {
                            fromdate: fromdate,
                            toDate: toDate
                        },
                        success: function(data) {
                            $('#example1').html(data);
                        }
                    });
                } else {
                    alert("Please Select Date");
                }
            });
        });
    </script> --}}
@endsection
