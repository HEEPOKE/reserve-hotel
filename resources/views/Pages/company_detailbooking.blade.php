@extends('adminlte::page')
<style>
    /*left right modal*/
    .modal.left_modal,
    .modal.right_modal {
        position: fixed;
        z-index: 99999;
    }

    .modal.left_modal .modal-dialog,
    .modal.right_modal .modal-dialog {
        position: fixed;
        margin: 1.5%;
        width: 32%;
        height: 55%;
        left: 10%;
        /* -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
        -o-transform: translate3d(0%, 0, 0);
        transform: translate3d(0%, 0, 0); */
    }

    .modal-dialog {
        /* max-width: 100%; */
        /* margin: 1.75rem auto; */
    }

    @media (min-width: 576px) {
        .left_modal .modal-dialog {
            /* max-width: 100%; */
        }

        .right_modal .modal-dialog {
            /* max-width: 100%; */
        }
    }

    .modal.left_modal .modal-content,
    .modal.right_modal .modal-content {
        /*overflow-y: auto;
    overflow-x: hidden;*/
        /* height: 100vh !important; */
    }

    .modal.left_modal .modal-body,
    .modal.right_modal .modal-body {
        /* padding: 15px 15px 30px; */
    }

    /*.modal.left_modal  {
    pointer-events: none;
    background: transparent;
    }*/

    /*Left*/
    .modal.left_modal.fade .modal-dialog {
        left: -50%;
        -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
        -o-transition: opacity 0.3s linear, left 0.3s ease-out;
        transition: opacity 0.3s linear, left 0.3s ease-out;
    }

    .modal.left_modal.fade.show .modal-dialog {
        left: 0;
        box-shadow: 0px 0px 19px rgba(0, 0, 0, .5);
    }

    /*Right*/
    .modal.right_modal.fade .modal-dialog {
        /* right: -50%; */
        -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
        -o-transition: opacity 0.3s linear, right 0.3s ease-out;
        transition: opacity 0.3s linear, right 0.3s ease-out;
    }



    .modal.right_modal.fade.show .modal-dialog {
        right: 0;
        box-shadow: 0px 0px 19px rgba(0, 0, 0, .5);
    }

    /* ----- MODAL STYLE ----- */
    .modal-content {
        border-radius: 0;
        border: none;
    }



    .modal-header.left_modal,
    .modal-header.right_modal {

        /* padding: 10px 15px; */
        border-bottom-color: #EEEEEE;
        background-color: #FAFAFA;
    }

    .modal_outer .modal-body {
        /*height:90%;*/
        overflow-y: auto;
        overflow-x: hidden;
        /* height: 91vh; */
    }
</style>
@section('content')
    @php
        $i = 1;
    @endphp
    <div class="card mt-3">
        <div class="wrapper_all">
            <div class="card-header border-info bgtable mb-2">
                <h3 class="card-title text-white">ข้อมูลประเภทการจอง</h3>
                <button type="button" class="btn btn-success float-end mr-2" data-toggle="modal"
                    data-target="#insertreserveModal">เพิ่มประเภทการจอง</button>
            </div>

            {{-- <div class="row">
                    <div class="row col-3">
                        <div class="">
                            <input class="form-control" type="text" id="search_input_all"
                                onkeyup="FilterkeyWord_all_table()" placeholder="ค้นหาชื่อ.." title="Type in a name">
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-success float-end mr-2" data-toggle="modal"
                            data-target="#sendmailModal">ส่งเมลล์</button>
                    </div> --}}

            <!-- Insert Modal -->
            <div wire:ignore.self class="modal fade" id="insertreserveModal" tabindex="-1"
                aria-labelledby="insertreserveModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header card-header bg-success border-success">
                            <h5 class="modal-title" id="insertreserveModalLabel">เพิ่มประเภทการจอง</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('insert-booking') }}" method="POST">
                            @csrf
                            @if ($catagoriesall === '')
                            @php
                            $catagoriessum = 1;
                            @endphp
                            @else
                            @foreach ($catagoriesall as $catagoriesallrow)
                            @endforeach
                            @php
                                $catagoriessum = $catagoriesallrow->id+1;
                            @endphp
                            @endif


                            <input type="hidden" name="booking_id" value="{{ date('dmY') }}{{ $catagoriessum }}{{ Auth::user()->company_id }}">
                            <input type="hidden" name="hotel_id" value="{{ Auth::user()->company_id }}">
                            <div class="modal-body">
                                <div class="mt-1">
                                    <label>ประเภท</label>
                                    <select class="form-control" name="cat_name" required>
                                        <option hidden selected>
                                            <-- กรุณาเลือก -->
                                        </option>
                                        <option value="โรงแรม">โรงแรม</option>
                                        <option value="กางเต้น">กางเต้น</option>
                                        <option value="รถบ้าน">รถบ้าน</option>
                                    </select>
                                </div>

                            {{-- @if ($message = Session::get('status'))
                                <script>
                                    Swal.fire({
                                        title: 'เพิ่มข้อมูลการจองสำเร็จ!',
                                        text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                                        icon: 'success'
                                    });
                                </script>
                            @else
                            @endif --}}
                            </div>
                            @if ($message = Session::get('status'))
                                <script>
                                    Swal.fire({
                                        title: 'เพิ่มข้อมูลการจองสำเร็จ!',
                                        text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                                        icon: 'success'
                                    });
                                </script>
                            @else
                            @endif
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">บันทึก</button>
                                <button type="button" class="btn btn-secondary" wire:click="closeModal"
                                    data-dismiss="modal">ยกเลิก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="container">
                <table class="table table-bordered mt-3 text-center dtr-inline" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">ลำดับ</th>
                            <th class="text-center">ประเภท</th>
                            <th class="text-center">เลขbooking</th>
                            <th class="text-center col-2">จัดการข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($catagories as $key => $row)
                            <tr>
                                <td class="text-center">{{ $key + $catagories->firstItem() }}</td>
                                <td class="text-center">{{ $row->cat_name }}</td>
                                <td class="text-center">{{ $row->booking_id }}</td>


                                <td class="text-center">
                                    <a type="button" class="btn btn-warning" href="{{ url('detailreserve', $row->booking_id) }}"><i
                                        class="fas fa-edit"></i></a>
                                    {{-- <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#deletereserveModal{{ $row->id }}"><i
                                            class="fas fa-trash-alt"></i></button> --}}
                                </td>
                            </tr>
                    </tbody>

                    @php
                        $checkpayment_slip = $row->payment_slip;
                        $paymentimg = $checkpayment_slip;
                        $payment_status = $row->payment_status;
                        $slipimg = explode(',', $checkpayment_slip);
                        $payment_slip = implode(',', $slipimg);
                    @endphp

                    @endforeach
                </table>
                <div class="float-end mt-2 mr-3">
                    {!! $catagories->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>



    @if ($message = Session::get('delete'))
        <script>
            Swal.fire({
                title: 'ทำการลบสำเร็จ!',
                text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                icon: 'success'
            });
        </script>
    @endif

    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                title: 'แก้ไขข้อมูลการจองสำเร็จ!',
                text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                icon: 'success'
            });
        </script>
    @endif
@endsection

<script>
    function load_data() {
        myStopFunction();
        var jdata = null;
        $.ajax({
            url: 'https://localhost:8182/thaiid/read.jsonp?callback=callback&section1=true&section2a=true&section2c=true',
            method: 'GET',
            type: 'JSON',
            success: function(jsondata) {
                var data = jsondata.substr(13, jsondata.length - 14);
                jdata = JSON.parse(data);
                if (jdata !== null) {
                    audio.play();
                    setTimeout(function() {
                        check_data_card(jdata.CitizenNo, jdata);
                    }, 500);

                } else {
                    $.busyLoadFull("hide");
                    start_read();
                    myStopFunction();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $.busyLoadFull("hide");
                Swal.fire({
                    type: 'warning',
                    title: 'ไม่สำเร็จ',
                    text: 'ยังไม่มีการอนุญาตการอ่านบัตร!' + textStatus
                }).then((res) => {
                    start_read();
                    myStopFunction();
                });
            }
        })
    }

    function check_data_card(id_card, jdata) {

        // var day1 = $("#day_class").val();
        // var subject_id = $("#subject_id").val();

        // if (day1 !== "" && subject_id !== "" && id_card !== "") {
        var id = $('#btnnnn').attr("data-id");
        let url = '/detailreserve/';
        $.ajax({
            method: "GET",
            url: url,
            data: {
                id: id

            },
            success: function(data) {
                $("#res").html(data.substr(2, data.length));
                $("#check_status").val(data.substr(1, 1));

                $("#CitizenNo").val(jdata.CitizenNo);
                $("#TitleNameTh").val(jdata.TitleNameTh);
                $("#FirstNameTh").val(jdata.FirstNameTh);
                $("#LastNameTh").val(jdata.LastNameTh);
                $("#TitleNameEn").val(jdata.TitleNameEn);
                $("#FirstNameEn").val(jdata.FirstNameEn);
                $("#LastNameEn").val(jdata.LastNameEn);
                $("#HomeNo").val(jdata.HomeNo);
                $("#Soi").val(jdata.Soi);
                $("#Tumbol").val(jdata.Tumbol);
                $("#Amphur").val(jdata.Amphur);
                $("#Road").val(jdata.Road);
                $("#Province").val(jdata.Province);
                $("#BirthDate").val(jdata.BirthDate);
                $("#Gender").val(jdata.Gender);
                var image = new Image();
                image.className = "fix_image";
                image.src = "data:image/png;base64," + jdata.Photo;
                $('#photo').html(image.src);

                // alert('Your id is =' + id);
                // check_card1(jdata);
            }
        });
        // } else {
        //     $.busyLoadFull("hide");
        //     Swal.fire({
        //         type: 'error',
        //         title: 'เตือน',
        //         text: 'กรุณาเลือกข้อมูลให้ครบถ้วน!'
        //     }).then((res) => {
        //         start_read();
        //     });
        // }

    }
    var modalid = null;

    function openmodal(id) {
        modalid = id
        $("#cardreserveModal").modal("toggle");
        start_read(modalid);

        console.log(id);
    }

    function readdata() {
        start_read(modalid);
    }

    function closemodal() {
        // $("#formmodal").reset();
        document.getElementById("formmodal").reset();
        $("#cardreserveModal").modal("toggle");
    }

    function submitdata(event, form) {
        event.preventDefault();
        const formdata = new FormData(form);
        $.ajax({
            method: "POST",
            url: '/smart-insert/' + modalid,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                // location.reload();
                Swal.fire({
                    title: 'เพิ่มข้อมูลสำเร็จ!',
                    text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                    icon: 'success',
                }).then(function() {
                    location.reload();
                });
                $("#cardreserveModal").modal("toggle");
            }
        });
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $(document).on('change', '.type_room', function() {

            var typeid = $(this).val();
            // console.log(typeid);
            var div = $(this).parent();

            var op = " ";

            var _token = $('input[name="_token"]').val();

            $.ajax({
                type: 'post',
                url: '{{ url('findselect') }}',
                data: {
                    'id': typeid,
                    '_token': _token
                },

                success: function(data) {
                    // console.log('success');

                    // console.log(data);

                    // console.log(data.length);
                    op += '<option value="0" selected disabled>กรุณาเลือกห้อง</option>';
                    for (var i = 0; i < data.length; i++) {
                        op += '<option value="' + data[i].id + '">' + data[i].
                        selectroom_id + '</option>';
                    }

                    div.find('.selectroom_id').html(" ");
                    div.find('.selectroom_id').append(op);

                    // $(.'room_id').html($selectroom);

                },
                error: function() {

                }
            })

        });

    });
</script>

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
</script>
