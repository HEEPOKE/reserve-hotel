/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var audio = new Audio('./sound/ti.mp3');

var myVar = null;

function start_read() {
    myStopFunction();
    myVar = setInterval(load_data, 100);
}

function myStopFunction() {
    clearInterval(myVar);
}

// function load_data() {
//    myStopFunction();
//     var jdata = null;
//     $.ajax({
//         url: 'https://localhost:8182/thaiid/read.jsonp?callback=callback&section1=true&section2a=true&section2c=true',
//         method: 'GET',
//         type: 'JSON',
//         success: function (jsondata) {
//             var data = jsondata.substr(13, jsondata.length - 14);
//             jdata = JSON.parse(data);
//             if (jdata !== null) {
//                 audio.play();
//                 setTimeout(function(){
//                     check_data_card(jdata.CitizenNo, jdata);
//                 },500);

//             }else{
//                 $.busyLoadFull("hide");
//                 start_read();
//             }
//         }, error: function (jqXHR, textStatus, errorThrown) {
//             $.busyLoadFull("hide");
//             Swal.fire({
//                 type: 'warning',
//                 title: 'ไม่สำเร็จ',
//                 text: 'ยังไม่มีการอนุญาตการอ่านบัตร!' + textStatus
//             }).then((res) => {
//                 start_read();
//             });
//         }
//     })
// }




// function check_data_card(id_card, jdata) {

//     var day1 = $("#day_class").val();
//     var subject_id = $("#subject_id").val();

//     if (day1 !== "" && subject_id !== "" && id_card !== "") {
//         $.ajax({
//             method: "GET",
//             url: '/detailreserve/',
//             data: {
//                 card_id: id_card,
//                 day: day1,
//                 status: 1,
//                 subject_id: subject_id,
//                 key: "load_member_check"
//             },
//             success: function (data) {
//                 $("#res").html(data.substr(2, data.length));
//                 $("#check_status").val(data.substr(1, 1));

//               $("#CitizenNo").text(jdata.CitizenNo);
//               $("#TitleNameTh").text(jdata.TitleNameTh);
//             $("#FirstNameTh").text(jdata.FirstNameTh);
//             $("#LastNameTh").text(jdata.LastNameTh);
//             $("#TitleNameEn").text(jdata.TitleNameEn);
//             $("#FirstNameEn").text(jdata.FirstNameEn);
//             $("#LastNameEn").text(jdata.LastNameEn);
//             $("#HomeNo").text(jdata.HomeNo);
//             $("#Soi").text(jdata.Soi);
//             $("#Tumbol").text(jdata.Tumbol);
//             $("#Amphur").text(jdata.Amphur);
//             $("#Road").text(jdata.Road);
//             $("#Province").text(jdata.Province);
//             $("#BirthDate").text(jdata.BirthDate);
//             $("#Gender").text(jdata.Gender);

//                 var image = new Image();
//             image.className = "fix_image";
//             image.src = "data:image/png;base64," + jdata.Photo;
//             $('#photo').html(image);
//                 check_card1(jdata);
//             }
//         });
//     } else {
//         $.busyLoadFull("hide");
//         Swal.fire({
//             type: 'error',
//             title: 'เตือน',
//             text: 'กรุณาเลือกข้อมูลให้ครบถ้วน!'
//         }).then((res) => {
//                 start_read();
//             });
//     }

// }


