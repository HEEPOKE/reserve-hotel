<div class="row">
    <div class="col-4">
        <div class="wrapper_all">
        <div class="card card-warning">
            <div class="card-header">
                <h4 class="card-title">ลูกค้าที่รอเช็คอินล่าสุด</h4>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

                <div class="">
                    <input class="form-control" type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()"
                        placeholder="ค้นหาชื่อ.." title="Type in a name">
                </div>

            <div class="card-body p-0">
                <table class="table table-sm" id="example1">
                    <thead>
                        <tr>
                            <th class="text-center">ชื่อ</th>
                            <th class="text-center">เบอร์โทร</th>
                            <th class="text-center">สถานะ</th>
                        </tr>
                    </thead>
                    @foreach ($wait_checkin as $row1)
                        <tbody>
                            <tr>
                                <td class="text-center">{{ $row1->first_name }}</td>
                                <td class="text-center">{{ 'T.' . ' ' . $row1->tel }}</td>
                                <td class="text-center"><span class="badge bg-warning">รอเช็คอิน</span></td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
                {!! $wait_checkin->links('pagination::bootstrap-4') !!}
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary float-end"
                    onclick="window.location.href='{{ url('detailreserve') }}'">ดูทั้งหมด</button>
            </div>
        </div>
        </div>
    </div>
    <div class="col-4">
        <div class="wrapper_all2">
        <div class="card card-success">
            <div class="card-header">
                <h4 class="card-title">ลูกค้าที่เช็คอินล่าสุด</h4>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="">
                <input class="form-control" type="text" id="search_input_all2" onkeyup="FilterkeyWord_all_table2()"
                    placeholder="ค้นหาชื่อ.." title="Type in a name">
            </div>
            <div class="card-body p-0">
                <table class="table table-sm" id="example2">
                    <thead>
                        <tr>
                            <th class="text-center">ชื่อ</th>
                            <th class="text-center">เบอร์โทร</th>
                            <th class="text-center">สถานะ</th>
                        </tr>
                    </thead>
                    @foreach ($checkin as $row2)
                        <tbody>
                            <tr>
                                <td class="text-center">{{ $row2->first_name }}</td>
                                <td class="text-center">{{ 'T.' . ' ' . $row2->tel }}</td>
                                <td class="text-center"><span class="badge bg-success">เช็คอิน</span></td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
                {!! $checkin->links('pagination::bootstrap-4') !!}
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary float-end"
                    onclick="window.location.href='{{ url('detailreserve') }}'">ดูทั้งหมด</button>
            </div>
        </div>
        </div>
    </div>
    <div class="col-4">
        <div class="wrapper_all3">
        <div class="card card-danger">
            <div class="card-header">
                <h4 class="card-title">ลูกค้าที่เช็คเอ้าท์ล่าสุด</h4>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="">
                <input class="form-control" type="text" id="search_input_all3" onkeyup="FilterkeyWord_all_table3()"
                    placeholder="ค้นหาชื่อ.." title="Type in a name">
            </div>
            <div class="card-body p-0">
                <table class="table table-sm" id="example3">
                    <thead>
                        <tr>
                            <th class="text-center">ชื่อ</th>
                            <th class="text-center">เบอร์โทร</th>
                            <th class="text-center">สถานะ</th>
                        </tr>
                    </thead>
                    @foreach ($checkout as $row3)
                        <tbody>
                            <tr>
                                <td class="text-center">{{ $row3->first_name }}</td>
                                <td class="text-center">{{ 'T.' . ' ' . $row3->tel }}</td>
                                <td class="text-center"><span class="badge bg-danger">เช็คเอ้าท์</span></td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
                {!! $checkout->links('pagination::bootstrap-4') !!}
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary float-end"
                    onclick="window.location.href='{{ url('detailreserve') }}'">ดูรายชื่อทั้งหมด</button>
            </div>
        </div>
    </div>
    </div>
</div>


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
              for(j = 0; j < count; j++){
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
              if(flag==1){
                         tr[i].style.display = "";
              }else {
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
              for(j = 0; j < count; j++){
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
              if(flag==1){
                         tr[i].style.display = "";
              }else {
                 tr[i].style.display = "none";
              }
            }
        }
  </script>

<script>
    function FilterkeyWord_all_table3() {

    // Count td if you want to search on all table instead of specific column

      count = $('.wrapper_all3 .table').children('tbody').children('tr:first-child').children('td').length;

            // Declare variables
            var input, filter, table, tr, td, i;
            input = document.getElementById("search_input_all3");
            filter = input.value.toLowerCase();

            table = document.getElementById("example3");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 1; i < tr.length; i++) {

              var flag = 0;
              for(j = 0; j < count; j++){
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
              if(flag==1){
                         tr[i].style.display = "";
              }else {
                 tr[i].style.display = "none";
              }
            }
        }
  </script>
