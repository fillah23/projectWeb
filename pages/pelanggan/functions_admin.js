$(document).ready(function () {
    getdata();
    addData();
    viewData();
});

function viewData() {
    $(document).on("click", "#btn-view", function () {

        var kode = $(this).closest('tr').find('.pelanggan_id').text();
        // alert(stud_id);

        $.ajax({
            type: "POST",
            url: "pelanggan/code.php",
            data: {
                'checking_view': true,
                'kode_pelanggan': kode,
            },
            success: function (response) {
                // console.log(response);
                $.each(response, function (key, studview) {
                    // console.log(studview['fname']);
                    $('.id_view').text(studview['kode_pelanggan']);
                    $('.nama_view').text(studview['nama_pelanggan']);
                    $('.email_view').text(studview['email_pelanggan']);
                    $('.password_view').text(studview['password']);
                    $('.nomer_hp_view').text(studview['nomer_hp']);
                    $('.status_view').text(studview['status']);
                    $('.nama_produk_view').text(studview['nama_produk']);
                    $('.harga_view').text(studview['harga_produk']);
                    $('.tanggal_view').text(studview['tanggal_berlangganan']);

                });
                document.querySelector(".view").classList.add("active");
                $(".view").css({
                    "box-shadow": "0 0 0 500vmax rgb(0 0 0 / 0.5)"
                });
            }
        });

    });
}
function getdata() {
    $.ajax({
        type: "GET",
        url: "pelanggan/fetch.php",
        success: function (response) {
            // console.log(response);
            $.each(response, function (key, value) {
                // console.log(value['fname']);
                $('.tabel').append('<tr>' +
                    '<td class="pelanggan_id" style="width: 10%;">' + value[
                        'kode_pelanggan'] + '</td>\
                            <td style="width: 20%;">' + value['nama_pelanggan'] + '</td>\
                            <td style="width: 20%;">' + value['nomer_hp'] + '</td>\
                            <td style="width: 22%;">' + value['nama_produk'] + '</td>\
                            <td style="width: 18%;">' + value['status'] +
                    '</td>\
                            <td style="width: 12%;">\
                            <a href="#" id="btn-view">\
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"\
                                style="fill: rgba(105, 172, 193, 1)">\
                                <path\
                                d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316-.105-.316C21.927 11.617 19.633 5 12 5zm0 11c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4z"></path><path d="M12 10c-1.084 0-2 .916-2 2s.916 2 2 2 2-.916 2-2-.916-2-2-2z">\
                                </path>\
                            </svg>\
                            </a>\
                            </td>\
                        </tr>');
            });
        }
    });
}

function addData() {
    $('#submit').click(function (e) {
        e.preventDefault();
        var kode = $('#kode').val();
        var nama = $('#nama').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var nomer_hp = $('#nomer_hp').val();
        var nama_produk = $('#nama_produk').val();
        var tanggal = $('#tanggal').val();
        var mailformat = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

        $.ajax({
            type: "POST",
            url: "pelanggan/code.php",
            data: {
                'validasi_email': true,
                'email_pelanggan': email,
            },
            success: function (response) {
                if (response == 0) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Email sudah ada',
                        showConfirmButton: false,
                        timer: 2000
                    })
                } else {
                    if (kode != '' & nama != '' & email != '' & password != '' & nomer_hp !=
                        '' & nama_produk != '') {
                        if (email.match(mailformat)) {
                            $.ajax({
                                type: "POST",
                                url: "pelanggan/code.php",
                                data: {
                                    'checking_add': true,
                                    'kode_pelanggan': kode,
                                    'nama_pelanggan': nama,
                                    'email_pelanggan': email,
                                    'password': password,
                                    'nomer_hp': nomer_hp,
                                    'nama_produk': nama_produk,
                                    'tanggal_berlangganan': tanggal,
                                },
                                success: function (response) {
                                    document.querySelector(".popup").classList
                                        .remove("active");
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
                                    $('#email').val("");
                                    $('#password').val("");
                                    $('#nomer_hp').val("");
                                    $('#nama_produk').val("");
                                    $('#harga').val("");
                                    $('#tanggal').val("");
                                }
                            });
                        } else {
                            // console.log("Please enter all fileds.");
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Format email salah',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
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
                }

            }
        });

    });
}