@extends('adminlte::page')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')
    <div class="card mt-3">
        <div class="wrapper_all">
            <div class="card-header border-info bgtable">
                <h3 class="card-title text-white">ระบบรับชำระเงินผ่านช่องทางต่างๆ</h3>
                <button type="button" class="btn btn-success float-end mr-2" data-toggle="modal"
                    data-target="#insertpaymentcompanyModal">เพิ่มช่องทางการรับเงิน</button>
            </div>
            <div class="container-fluid mt-2">
                <!-- Insert Modal -->
                <div wire:ignore.self class="modal fade" id="insertpaymentcompanyModal" tabindex="-1"
                    aria-labelledby="insertpaymentcompanyModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header card-header bg-success border-success">
                                <h5 class="modal-title" id="insertpaymentcompanyModalLabel">เพิ่มช่องทางการรับเงิน</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ url('insert-paymentcompany') }}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="company_id" value="{{ auth()->user()->company_id }}">
                                @csrf

                                <div class="modal-body">
                                    @foreach ($banks as $row6)
                                        @if ($row6->id > 1)
                                            @php
                                                $provider_payment_methods2 = DB::table('provider_payment_methods')
                                                    ->orderBy('id', 'DESC')
                                                    ->limit(1)
                                                    ->update(['bank_id' => $row6->id]);

                                            @endphp
                                        @endif
                                    @endforeach

                                    <div class="mb-3">
                                        <label>ประเภทการชำระเงิน</label>
                                        <select class="form-control" name="payment_type" required>
                                            <option hidden selected>
                                                <-- กรุณาเลือก -->
                                            </option>
                                            <option value="banking">banking</option>
                                            <option value="บัตรเครดิต">บัตรเครดิต</option>
                                            <option value="พร้อมเพย์">พร้อมเพย์</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>ชื่อธนาคาร</label>
                                        <select class="form-control" name="bank_name" required>
                                            <option hidden selected>
                                                <-- กรุณาเลือก -->
                                            </option>
                                            <option value="ธนาคารกรุงไทย">ธนาคารกรุงไทย</option>
                                            <option value="ธนาคารกสิกรไทย">ธนาคารกสิกรไทย</option>
                                            <option value="ธนาคารออมสิน">ธนาคารออมสิน</option>
                                            <option value="ธนาคารกรุงเทพ">ธนาคารกรุงเทพ</option>
                                            <option value="ธนาคารไทยพาณิชย์">ธนาคารไทยพาณิชย์</option>
                                            <option value="ธนาคารกรุงศรี">ธนาคารกรุงศรี</option>
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <label>เลขที่บัญชี</label>
                                        <input type="number" name="bank_account_no" class="form-control" required>
                                        @error('bank_account_no')
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
            </div>
            {{-- <div class="mt-2">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close float-end" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p><strong>{{ $message }}</strong></p>
                    </div>
                @endif
            </div> --}}
            <div class="container">
                <table class="table table-bordered mt-3 dtr-inline" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">ลำดับ</th>
                            {{-- <th class="text-center">ชื่อบริษัท</th> --}}
                            <th class="text-center">ประเภทการชำระเงิน</th>
                            <th class="text-center">ชื่อธนาคาร</th>
                            <th class="text-center">เลขที่บัญชี</th>
                            <th class="text-center">รหัสโค้ดธนาคาร</th>
                            <th class="text-center" width="280px">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Provider_payment_methods as $key => $row)
                            <tr>
                                <td class="text-center">{{ $key + $Provider_payment_methods->firstItem() }}</td>
                                <td class="text-center">{{ $row->payment_type }}</td>
                                <td class="text-center">{{ $row->bank_name }}</td>
                                <td class="text-center">{{ $row->bank_account_no }}</td>
                                <td class="text-center">{{ $row->bank_code }}</td>
                                <td class="text-center">
                                    {{-- <button type="button" class="btn btn-info" data-toggle="modal"
                            data-target="#viewstatusModal">ดูรายละเอียด</button> --}}
                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-target="#editpaymentcompanyModal{{ $row->id }}"><i
                                            class="fas fa-edit"></i></button>
                                    {{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteproviderModal{{ $row->id }}" >ลบ</button> --}}
                                </td>

                            </tr>
                            <!-- edit Modal -->
                            <div wire:ignore.self class="modal fade" id="editpaymentcompanyModal{{ $row->id }}"
                                tabindex="-1" aria-labelledby="editpaymentcompanyModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header card-header bg-warning border-warning">
                                            <h5 class="modal-title" id="editpaymentcompanyModalLabel">
                                                แก้รายละเอียดผู้ประกอบการ
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ url('update-paymentcompany', $row->id) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="renew_contract" value="1">
                                            @method('PUT')

                                            <div class="modal-body">

                                                <div class="mt-1">
                                                    <label>ประเภทการชำระเงิน</label>
                                                    <select class="form-control" name="payment_type">
                                                        <option hidden selected value="{{ $row->payment_type }}">
                                                            {{ $row->payment_type }}</option>
                                                        <option value="banking">banking</option>
                                                        <option value="บัตรเครดิต">บัตรเครดิต</option>
                                                        <option value="พร้อมเพย์">พร้อมเพย์</option>
                                                    </select>
                                                </div>
                                                <div class="mt-3">
                                                    <label>ชื่อธนาคาร</label>
                                                    <select class="form-control" name="bank_name">
                                                        <option hidden selected value="{{ $row->bank_name }}">
                                                            {{ $row->bank_name }}</option>
                                                        <option value="ธนาคารกรุงไทย">ธนาคารกรุงไทย</option>
                                                        <option value="ธนาคารกสิกรไทย">ธนาคารกสิกรไทย</option>
                                                        <option value="ธนาคารออมสิน">ธนาคารออมสิน</option>
                                                        <option value="ธนาคารกรุงเทพ">ธนาคารกรุงเทพ</option>
                                                        <option value="ธนาคารไทยพานิชย์">ธนาคารไทยพานิชย์</option>
                                                        <option value="ธนาคารกรุงศรี">ธนาคารกรุงศรี</option>
                                                    </select>
                                                </div>
                                                <div class="mt-3">
                                                    <label>เลขที่บัญชี</label>
                                                    <input type="text" name="bank_account_no" class="form-control"
                                                        maxlength="10" value="{{ $row->bank_account_no }}" required>
                                                    @error('bank_account_no')
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
                    </tbody>
                </table>
                {!! $Provider_payment_methods->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>

    @if ($message = Session::get('status'))
        <script>
            Swal.fire({
                title: 'เพิ่มช่องทางชำระสำเร็จ!',
                text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                icon: 'success'
            });
        </script>
    @endif
    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                title: 'แก้ไขช่องทางชำระสำเร็จ!',
                text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                icon: 'success'
            });
        </script>
    @endif
@endsection
{{--
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
