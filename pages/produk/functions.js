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
document.querySelector(".edit .close-btn").addEventListener("click", function () {
    document.querySelector(".edit").classList.remove("active");
    $(".edit").css({
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
    cek_edit();
    editData();
    hapus();
});

function hapus() {
    $(document).on("click", "#btn-hapus", function () {

        var kode_produk = $(this).closest('tr').find('.produk_id').text();
        // alert(stud_id);
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data akan hilang jika dihapus!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "produk/code.php",
                    data: {
                        'checking_delete': true,
                        'kode_produk': kode_produk,
                    },
                    success: function (response) {
                        if(response == 0)
                        {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Berhasil dihapus',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }else{
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Produk tidak bisa di hapus',
                                text : 'Ada pelanggan yang berlangganan produk ini',
                                showConfirmButton: true,
                                // timer: 2000
                            })
                        }
                        $('.tabel').html("");
                        getdata();
                    }
                });

            }
        });


    });
}

function editData() {
    $('#edit_button').click(function (e) {
        e.preventDefault();

        var kode = $('#id_edit').val();
        var nama = $('#nama_edit').val();
        var harga = $('#harga_edit').val();
        var stok = $('#stok_edit').val();
        var kecepatan = $('#kecepatan_edit').val();

        if (nama != '' & harga != '' & stok != '' & kecepatan != '') {
            $.ajax({
                type: "POST",
                url: "produk/code.php",
                data: {
                    'checking_update': true,
                    'kode_produk': kode,
                    'nama_produk': nama,
                    'harga_produk': harga,
                    'stok': stok,
                    'kecepatan': kecepatan,
                },
                success: function (response) {
                    // console.log(response);
                    document.querySelector(".edit").classList.remove("active");
                    $(".edit").css({
                        "box-shadow": "none"
                    });
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response,
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $('.tabel').html("");
                    getdata();

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

function cek_edit() {
    $(document).on("click", "#btn-edit", function () {

        var kode_produk = $(this).closest('tr').find('.produk_id').text();
        // alert(stud_id);

        $.ajax({
            type: "POST",
            url: "produk/code.php",
            data: {
                'checking_edit': true,
                'kode_produk': kode_produk,
            },
            success: function (response) {
                // console.log(response);
                $.each(response, function (key, value) {
                    // console.log(studview['fname']);
                    $('#id_edit').val(value['kode_produk']);
                    $('#nama_edit').val(value['nama_produk']);
                    $('#harga_edit').val(value['harga_produk']);
                    $('#stok_edit').val(value['bandwith']);
                    $('#kecepatan_edit').val(value['kecepatan']);
                });
                document.querySelector(".edit").classList.add("active");
                $(".edit").css({
                    "box-shadow": "0 0 0 500vmax rgb(0 0 0 / 0.5)"
                });
            }
        });

    });
}

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
                            <td style="width: 10%;" class="aksi_produk">\
                            <a href="#" id="btn-edit">\
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"\
                                style="fill: rgba(255, 212, 0, 1);">\
                                <path\
                                    d="M8.707 19.707 18 10.414 13.586 6l-9.293 9.293a1.003 1.003 0 0 0-.263.464L3 21l5.242-1.03c.176-.044.337-.135.465-.263zM21 7.414a2 2 0 0 0 0-2.828L19.414 3a2 2 0 0 0-2.828 0L15 4.586 19.414 9 21 7.414z">\
                                </path>\
                            </svg>\
                        </a>\
                            <a href="#" id="btn-hapus">\
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"\
                                style="fill: rgba(227, 71, 36, 1);">\
                                <path\
                                    d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm10.618-3L15 2H9L7.382 4H3v2h18V4z">\
                                </path>\
                            </svg>\
                        </a>\
                            </td>\
                        </tr><script>$(".aksi_produk").hide();if(document.getElementById("level").value=="Super"){$(".aksi_produk").show();}</' + 'script>'
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

var x = sessionStorage.getItem("textvalue3");
var decrypted = CryptoJS.AES.decrypt(x, "Secret Passphrase");
document.getElementById("level").value = decrypted.toString(CryptoJS.enc.Utf8);