@extends('adminlte::page')
@section('content')
    @php $i=1; @endphp
    <div class="card mt-3">
        <div class="wrapper_all">
            <div class="card-header border-info bgtable">
                <h3 class="card-title text-white">รายชื่อลูกค้าที่จองออนไลน์</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="container-fluid mt-2">
                    <div class="row">
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
                    </div>
                </div>
                <div class="container">
                    <table class="table table-bordered dtr-inline" id="table">
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

                            @foreach ($customers as $key => $row)
                                <tr>
                                    <td style="display:none;">{{ $row->room_type }}</td>
                                    <td style="display:none;">{{ $row->stay_status }}</td>
                                    <td class="text-center">{{ $key + $customers->firstItem() }}</td>
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
                    <div class="float-end mt-2 mr-3">
                        {!! $customers->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="wrapper_all2">
            <div class="card-header border-info bgtable">
                <h3 class="card-title text-white">รายชื่อลูกค้าที่วอร์คอิน</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="container-fluid mt-2">
                    <div class="row">
                        <div class="row float-start col-8">
                            <div class="btn-group">
                                <select style="width: 15%;" class="selectreserve2" id="selectreserve2">
                                    <option value="all">ทั้งหมด</option>
                                    @foreach ($customers3b as $customersallb3)
                                        @if ($customersallb3->check_report == '0')
                                            <option value="{{ $customersallb3->check_report }}">
                                                รอเช็คอิน
                                            </option>
                                        @elseif($customersallb3->check_report == '1')
                                            <option value="{{ $customersallb3->check_report }}">
                                                เช็คอิน
                                            </option>
                                        @elseif($customersallb3->check_report == '2')
                                            <option value="{{ $customersallb3->check_report }}">
                                                เช็คเอ้าท์
                                            </option>
                                        @endif
                                        {{-- <option value="{{ $customersall->check_report }}">
                                    {{ $customersall->check_report }}
                                </option> --}}
                                    @endforeach
                                </select>
                                <select style="width: 15%;" class="selectcheck2" id="selectcheck2">
                                    <option value="all">ทั้งหมด</option>
                                    @foreach ($customers2b as $customersallb2)
                                        <option value="{{ $customersallb2->type_report }}">
                                            {{ $customersallb2->type_report }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered dtr-inline" id="table2">
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
                            @foreach ($customers4 as $key => $row)
                                <tr>
                                    <td style="display:none;">{{ $row->room_type }}</td>
                                    <td style="display:none;">{{ $row->stay_status }}</td>
                                    <td class="text-center">{{ $key + $customers4->firstItem() }}</td>
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
                    <div class="float-end mt-2 mr-3">
                        {!! $customers4->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        function FilterkeyWord_all_table2() {

            // Count td if you want to search on all table instead of specific column

            count = $('.wrapper_all2 .table').children('tbody').children('tr:first-child').children('td').length;

            // Declare variables
            var input, filter, table, tr, td, i;
            input = document.getElementById("search_input_all2");
            filter = input.value.toLowerCase();

            table = document.getElementById("example2");
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
    {{-- <script>
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
    </script> --}}
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
                    } else if ($(this).find('td:eq(1)').text() != '' || $(this).find('td:eq(0)').text() != '') {
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
            $("#selectcheck2,#selectreserve2").on("change", function() {
                var checkall = $('#selectcheck2').find("option:selected").val();
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
                    } else if ($(this).find('td:eq(1)').text() != '' || $(this).find('td:eq(0)').text() != '') {
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
