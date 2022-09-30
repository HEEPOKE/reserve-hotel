@extends('adminlte::page')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')
    @php
        date_default_timezone_set('Asia/Bangkok');
        // $data2 = date("Y-m-d");
        $data2 = date('Y-m-d H:i:s');

    @endphp
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <center><div class="card" style="width: 60%; height: 350px">
        <div class="card-body">
            <div class="container-fluid">
                <div class="row text-center">
                    <div class="text-center mt-3">
                        <h1><i class="fa fa-ban"  aria-hidden="true"></i></h1>
                    </div>
                    <div class="text-center mt-4">
                        <label><h3>บัญชีของคุณหมดอายุการใช้งาน</h3></label>
                    </div>
                    <div class="text-center mt-4">
                        <label><h3>สแกนQRcode</h3></label>
                    </div>
                    <div class="text-center mt-2">
                        <label><h5>สามารถติดต่อสอบถามได้ที่เบอร์ติดต่อ : 0847362521</h5></label>
                    </div>
                </div>
            </div>
        </div>
    </div></center>
@endsection
