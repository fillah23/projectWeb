//pop up tambah dan edit
document.querySelector("#show-login").addEventListener("click", function () {
    document.querySelector(".popup").classList.add("active");
    $(".popup").css({
        "box-shadow": "0 0 0 500vmax rgb(0 0 0 / 0.5)"
    });
});
document.querySelector(".popup .close-btn").addEventListener("click", function () {
    document.querySelector(".popup").classList.remove("active");
    $(".popup").css({
        "box-shadow": "none"
    });
});

// textfild angka
function onlyNumberKey(evt) {
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}

//query textfield
$(document).ready(function () {
    getdata();
    addData();
});

function getdata() {
    $.ajax({
        type: "GET",
        url: "produk/fetch.php",
        success: function (response) {
            // console.log(response);
            $.each(response, function (key, value) {
                // console.log(value['fname']);
                $('.tabel').append('<tr>' +
                    '<td class="produk_id" style="width: 20%;">' + value['kode_produk'] + '</td>\
                            <td style="width: 20%;">' + value['nama_produk'] + '</td>\
                            <td style="width: 10%;">' + value['kecepatan'] + 'Mbps'+'</td>\
                            <td style="width: 20%;">' + value['harga_produk'] + '</td>\
                            <td style="width: 20%;">' + value['bandwith'] + '</td>\
                        </tr>'
                );
            });
        }
    });
}

function addData() {
    $('#submit').click(function (e) {
        e.preventDefault();

        var kode = $('#kode').val();
        var nama = $('#nama').val();
        var harga = $('#harga').val();
        var stok = $('#stok').val();
        var kecepatan = $('#kecepatan').val();

        if (kode != '' & nama != '' & harga != '' & stok != '' & kecepatan != '') {
            $.ajax({
                type: "POST",
                url: "produk/code.php",
                data: {
                    'checking_add': true,
                    'kode_produk': kode,
                    'nama_produk': nama,
                    'harga_produk': harga,
                    'stok': stok,
                    'kecepatan': kecepatan,
                },
                success: function (response) {
                    // console.log(response);
                    document.querySelector(".popup").classList.remove("active");
                    $(".popup").css({
                        "box-shadow": "none"
                    });
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: "Data berhasil ditambah",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $('.tabel').html("");
                    getdata();
                    $('#kode').val(response);
                    $('#nama').val("");
                    $('#harga').val("");
                    $('#stok').val("");
                    $('#kecepatan').val("");
                }
            });

        } else {
            // console.log("Please enter all fileds.");
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Lengkapi data',
                showConfirmButton: false,
                timer: 2000
            })
        }

    });
}

//search
$(document).ready(function () {
    $('#search_produk').on('keyup', function () {
        $('#table-produk').load('produk/search.php?keyword=' + $('#search_produk').val());
    });
});
