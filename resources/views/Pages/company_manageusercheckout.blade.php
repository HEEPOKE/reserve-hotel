@extends('adminlte::page')
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-12 text-center mt-3">
                <h2>รายชื่อลูกค้าที่เช็คเอ้าท์</h2>
            </div>
            <div class="container mt-4 mb-2">
                <div class="row float-start col-8">
                    <div class="btn-group">
                        <select class="form-control col-3" name="status" id="status" onchange="location = this.value;">
                            <option hidden selected value="">
                                <--กรุณาเลือก-->
                            </option>
                            <option value="{{ url('manageuser') }}">จอง</option>
                            <option value="{{ url('manageusercheckin') }}">เข้าพัก</option>
                            <option value="{{ url('manageusercheckout') }}">เช็คเอ้าท์</option>
                        </select>
                        <select class="form-control mx-2 col-3" name="reporttypeSelect" id="reporttypeSelect"></select>
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
        <table class="table table-bordered table-striped dataTable dtr-inline" id="example1"
            aria-describedby="example1_info">
            <thead>
                <tr>
                    <th style="display:none;"></th>
                    <th style="display:none;"></th>
                    <th class="text-center">ลำดับ</th>
                    <th class="text-center">ชื่อ-นามสกุล</th>
                    <th class="text-center">เบอร์โทร</th>
                    <th class="text-center">อีเมล์</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $row)
                    <tr>
                        <td style="display:none;">{{ $row->room_type }}</td>
                        <td style="display:none;">{{ $row->walk_in_customers }}</td>
                        <td class="text-center">{{ $i++ }}</td>
                        <td class="text-center">{{ $row->first_name }} {{ $row->last_name }}</td>
                        <td class="text-center">{{ $row->tel }}</td>
                        <td class="text-center">{{ $row->email }}</td>
                    </tr>
            </tbody>
            @endforeach
        </table>
        {!! $customers->links('pagination::bootstrap-4') !!}
    </div>
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("example1");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
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
        NO_FILTERING = "ทั้งหมด"

        function populatePetTypeDropdown() {
            var options = [NO_FILTERING];

            $("#example1 tr").each(function(index, row) {
                var petType = getPetTypeForRow(row);
                if ((petType) && (options.indexOf(petType.trim()) == -1)) {
                    options.push(petType);
                }
            });
            options.sort();
            addOptionsToDropdown(options, "#reporttypeSelect");
        }

        function getPetTypeForRow(row) {
            return $(row).children("td").eq(0).html();
        }

        function addOptionsToDropdown(options, dropdownQuery) {
            for (var i = 0; i < options.length; i++) {
                $(dropdownQuery).append($("<option>", {
                    html: options[i],
                    value: options[i]
                }))
            }
        }

        function filterTableByPetType(petType) {
            $("#example1 tr").each(function(index, row) {
                var entryType = getPetTypeForRow(row);
                if (petType === entryType) {
                    $(row).show();
                } else {
                    $(row).hide();
                }
            });
        }

        function removeFiltering() {
            $("#example1 tr").each(function(index, row) {
                $(row).show();
            });
        }

        function setDropdownChangeHandler() {
            $("#reporttypeSelect").change(function(event) {
                var selection = $("#reporttypeSelect").val();
                if (selection !== NO_FILTERING) {
                    filterTableByPetType(selection);
                } else {
                    removeFiltering();
                }
            });
        }

        populatePetTypeDropdown();
        setDropdownChangeHandler();
    </script>
@endsection
