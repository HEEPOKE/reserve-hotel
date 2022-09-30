@extends('adminlte::page')
@section('content')
    <div class="card mt-3">
        <div class="card-header border-info" style="background-color: #0194F3">
            <h3 class="card-title text-white">ฟอร์มเพิ่มข้อมูลบัตรประชาชน</h3>
        </div>
        <input type="button" class="btn btn-warning" value="ดึงข้อมูลจากบัตรประชาชน" onclick="start_read()">

        <div class="container-fluid mt-2">

            <p class="text-center" id="photo"></p>

            <p>เลขบัตรประชาชน</p>
            <span id="CitizenNo"></span>

            <div class="row mt-3">
                <div class="col">
                    ตัวนำหน้า(ภาษาไทย)
                </div>
                <div class="col">
                    ชื่อ(ภาษาไทย)
                </div>
                <div class="col">
                    นามสกุล(ภาษาไทย)
                </div>
            </div>
            <div class="row mt-1">
                <div class="col">
                    <span id="TitleNameTh"></span>
                </div>
                <div class="col">
                    <span id="FirstNameTh"></span>
                </div>
                <div class="col">
                    <span id="LastNameTh"></span>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    ตัวนำหน้า(ภาษาอังกฤษ)
                </div>
                <div class="col">
                    ชื่อ(ภาษาอังกฤษ)
                </div>
                <div class="col">
                    นามสกุล(ภาษาอังกฤษ)
                </div>
            </div>
            <div class="row mt-1">
                <div class="col">
                    <span id="TitleNameEn"></span>
                </div>
                <div class="col">
                    <span id="FirstNameEn"></span>
                </div>
                <div class="col">
                    <span id="LastNameEn"></span>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    เกิดวันที่
                </div>
                <div class="col-10">
                    เพศ
                </div>

            </div>
            <div class="row mt-1">
                <div class="col">
                    <span id="BirthDate"></span>
                </div>
                <div class="col-10">
                    <span id="Gender"></span>
                </div>

            </div>
            <div class="row mt-3">
                <div class="col">
                    ที่อยู่
                </div>
                <div class="col">
                    ซอย
                </div>
                <div class="col">
                    ตำบล
                </div>
                <div class="col">
                    ถนน
                </div>
                <div class="col">
                    อำเภอ
                </div>
            </div>
            <div class="row mt-1">
                <div class="col">
                    <span id="HomeNo"></span>
                </div>
                <div class="col">
                    <span id="Soi"></span>
                </div>
                <div class="col">
                    <span id="Tumbol"></span>
                </div>
                <div class="col">
                    <span id="Road"></span>
                </div>
                <div class="col">
                    <span id="Amphur"></span>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    จังหวัด
                </div>
            </div>
            <div class="row mt-1">
                <div class="col">
                    <span id="Province"></span>
                </div>
            </div>
        @endsection
