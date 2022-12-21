//functions filter
function handledatechange() {
    var date_picker_end = document.getElementById("date_picker_end").value;
    document.getElementById("tanggal").value = changedateformat(date_picker_end);
}

function changedateformat(val) {
    const myArray = val.split("-");

    let year = myArray[0];
    let month = myArray[1];
    let day = myArray[2];

    let formatteddate = year + "-" + month + "-" + day;
    return formatteddate;
}

function handledatechange1() {
    var date_picker_end = document.getElementById("date_picker_end1").value;
    document.getElementById("tanggal2").value = changedateformat1(date_picker_end);
}

function changedateformat1(val) {
    const myArray = val.split("-");

    let year = myArray[0];
    let month = myArray[1];
    let day = myArray[2];

    let formatteddate = year + "-" + month + "-" + day;
    return formatteddate;
}

//
$(document).ready(function () {
    getdata();
    $('#range').click(function () {
        var From = $('#tanggal').val();
        var to = $('#tanggal2').val();
        if (From != '' && to != '') {
            $.ajax({
                url: "riwayat/range.php",
                method: "POST",
                data: {
                    From: From,
                    to: to
                },
                success: function (data) {
                    $('#table-riwayat').html(data);
                    $('#table-riwayat').append(data.htmlresponse);
                }
            });
        } else {
            alert("Please Select the Date");
        }
    });
});

//
function getdata() {
    $.ajax({
        type: "GET",
        url: "riwayat/fetch.php",
        success: function (response) {
            // console.log(response);
            $.each(response, function (key, value) {
                // console.log(value['fname']);
                $('.tabel').append('<tr>' +
                    '<td class="riwayat_id" >' + value['kode_transaksi'] + '</td>\
                            <td >' + value['nama_pelanggan'] + '</td>\
                            <td >' + value['nama_produk'] + '</td>\
                            <td >' + value['tanggal_transaksi'] + '</td>\
                            <td >' + value['kecepatan'] + '</td>\
                            <td >' + value['bandwith'] + '</td>\
                            <td >' + value['nama_akun'] + '</td>\
                            <td >' + value['harga_produk'] + '</td>\
                        </tr>');
            });
        }
    });
}

$(document).ready(function () {
    $('#search_riwayat').on('keyup', function () {
        $('#table-riwayat').load('riwayat/search.php?keyword=' + $('#search_riwayat').val());
    });
});

function printDiv() {
    let file = new Blob([$('#table-riwayat').html()], {
        type: "application/vnd.ms-excel"
    });
    let url = URL.createObjectURL(file);
    let a = $("<a />", {
        href: url,
        download: "filename.xls"
    }).appendTo("body").get(0).click();
    e.preventDefault();
}