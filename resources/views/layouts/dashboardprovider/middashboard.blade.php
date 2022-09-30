<div class="row">
    <div class="col-12">
        <div class="wrapper_all">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title">รายชื่อผู้ประกอบการที่สมัครใช้งานล่าสุด</h4>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="row col-3 mt-2">
                <div class="">
                    <input class="form-control" type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()"
                        placeholder="ค้นหาชื่อ.." title="Type in a name">
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="example1">
                    <thead>
                        <tr>
                            <th class="text-center col-1">ลำดับ</th>
                            <th class="text-center">ชื่อสถานประกอบการ</th>
                            <th class="text-center">อีเมล์</th>
                            <th class="text-center">เบอร์โทรศัพท์</th>
                            <th class="text-center">สถานะการหมดอายุ</th>
                        </tr>
                    </thead>
                    @foreach ($list_company as $key => $row1)
                        <tbody>
                            <td class="text-center">{{ $key+ $list_company->firstItem() }}</td>
                            <td class="text-center">{{ $row1->company_name }}</td>
                            <td class="text-center">{{ $row1->email }}</td>
                            <td class="text-center">{{ $row1->tel }}</td>
                            <td class="text-center">{{ $row1->license_status }}</td>
                        </tbody>
                    @endforeach
                </table>
                <div class="mt-2 float-end">
                    {!! $list_company->links('pagination::bootstrap-4') !!}
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary float-end"
                    onclick="window.location.href='{{ url('detailprovider') }}'">ดูรายชื่อผู้ประกอบการทั้งหมด</button>
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
