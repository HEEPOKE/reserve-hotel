<div class="card mt-3">
    <div class="wrapper_all">
        <div class="card-header bgtable">
            <h3 class="card-title text-white">รายชื่อประเภทห้องพัก</h3>
            <button type="button" class="btn btn-success float-end" data-toggle="modal"
                data-target="#typeroomModal">เพิ่มประเภทห้องพัก</button>
        </div>
        <div class="container-fluid mt-2">
            <table class="table table-bordered" id="typeroomtable">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 10px">ลำดับ</th>
                        <th class="text-center">ประเภทห้องพัก</th>
                        <th class="text-center">เพิ่มห้องพัก</th>
                        <th class="text-center col-2">ลบประเภทห้องพัก</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < $counttype; $i++)
                        <tr>
                            <td class="text-center">{{ $num++ }}</td>
                            <td class="text-center">{{ $Arraytype[$i] }}</td>
                            <td class="text-center">
                                <a type="button" class="btn btn-primary"
                                    href="{{ url('addroom', $Arraytype[$i]) }}">เพิ่มห้องพักประเภท{{ $Arraytype[$i] }}</a>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#deletetypeModal{{ $i }}">ลบ</button>
                            </td>
                        </tr>

                        @include('layouts.company_typeroom.delete_modal')
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
