function ShowImg(url) {

    var modal = document.getElementById("myModalll");

    document.getElementById("slippp").src = url;

    modal.style.display = "block";

    var span = document.getElementsByClassName("closeee")[0];

    span.onclick = function () {
        modal.style.display = "none";
    }
}

function selectDeleteImg(url, index) {
    document.getElementById("img-delete").src = url;
    document.getElementById("index-delete").value = index;
}

function removedetail(index) {
    document.getElementById("detail" + index).remove();
    document.getElementById("detailbutton" + index).remove();
}

function removefacilities(index) {
    document.getElementById("facilities" + index).remove();
    document.getElementById("facilitiesbutton" + index).remove();
}

function removeother(index) {
    document.getElementById("other" + index).remove();
    document.getElementById("other_quantity" + index).remove();
    document.getElementById("otherbutton" + index).remove();
}

function removemore_detail(index) {
    document.getElementById("more_detail" + index).remove();
    document.getElementById("more_detailbutton" + index).remove();
}

function removetyperoom(index) {
    document.getElementById("typeroom" + index).remove();
    document.getElementById("typeroombutton" + index).remove();
}

$(document).ready(function () {

    $('.input-images').imageUploader();

    var i = 1;

    $('#addroom_detail').click(function () {
        i++;
        $('#room_deteil').append('<div class="form-row mt-2" id="row3' + i +
            '"> <div class="col-10"> <input type="text" class="form-control"  name="room_detail[]" placeholder="กรอกรายละเอียดของห้องพัก"> </div> <div class="col-2"> <td><button type="button" name="add"  class="btn btn-danger btn_remove3" id="' +
            i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
    });

    $('#addroom_facilities').click(function () {
        i++;
        $('#room_facilities').append('<div class="form-row mt-2" id="row3' + i +
            '"> <div class="col-10"> <input type="text" class="form-control"  name="room_facilities[]" placeholder="กรอกสิ่งอำนวยความสะดวกภายในห้องพัก"> </div> <div class="col-2"> <td><button type="button" name="add"  class="btn btn-danger btn_remove3" id="' +
            i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
    });

    $('#addother').click(function () {
        i++;
        $('#other').append('<div class="form-row mt-2" id="row3' + i +
            '"> <div class="col-8"> <input type="text" class="form-control"  name="other[]" placeholder="กรอกของเสริม"> </div> <div class="col-2"> <input type="number" class="form-control"  name="other_quantity[]" placeholder="จำนวน"> </div> <div class="col-2"> <td><button type="button" name="add"  class="btn btn-danger btn_remove3" id="' +
            i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
    });

    $('#addmore_detail').click(function () {
        i++;
        $('#more_detail').append('<div class="form-row mt-2" id="row3' + i +
            '"> <div class="col-10"> <input type="text" class="form-control"  name="more_detail[]" placeholder="กรอกรายละเอียดเพิ่มเติมของห้อง"> </div> <div class="col-2"> <td><button type="button" name="add"  class="btn btn-danger btn_remove3" id="' +
            i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
    });

    $('#add_typeroom').click(function () {
        i++;
        $('#typeroom').append('<div class="form-row mt-2" id="row3' + i +
            '"> <div class="col-10"> <input type="text" class="form-control"  name="typeroom[]" placeholder="กรอกรายละเอียดเพิ่มเติมของห้อง"> </div> <div class="col-2"> <td><button type="button" name="add"  class="btn btn-danger btn_remove3" id="' +
            i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
    });

    $(document).on('click', '.btn_remove3', function () {
        var button_id = $(this).attr("id");

        $('#row3' + button_id + '').remove();
    });

});

var multipleCardCarousel = document.querySelector(
    "#carouselExampleControls"
);
if (window.matchMedia("(min-width: 768px)").matches) {
    var carousel = new bootstrap.Carousel(multipleCardCarousel, {
        interval: false,
    });
    var carouselWidth = $(".carousel-inner")[0].scrollWidth;
    var cardWidth = $(".carousel-item").width();
    var scrollPosition = 0;
    $("#carouselExampleControls .carousel-control-next").on("click", function () {
        if (scrollPosition < carouselWidth - cardWidth * 4) {
            scrollPosition += cardWidth;
            $("#carouselExampleControls .carousel-inner").animate(
                { scrollLeft: scrollPosition },
                600
            );
        }
    });
    $("#carouselExampleControls .carousel-control-prev").on("click", function () {
        if (scrollPosition > 0) {
            scrollPosition -= cardWidth;
            $("#carouselExampleControls .carousel-inner").animate(
                { scrollLeft: scrollPosition },
                600
            );
        }
    });
} else {
    $(multipleCardCarousel).addClass("slide");
}
