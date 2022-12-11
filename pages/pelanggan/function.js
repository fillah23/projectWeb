$(document).ready(function () {
    getdata();
    addData();
    cek_edit();
    editData();
    hapus();
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

function hapus() {
    $(document).on("click", "#btn-hapus", function () {

        var kode_pelanggan = $(this).closest('tr').find('.pelanggan_id').text();
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
                    url: "pelanggan/code.php",
                    data: {
                        'checking_delete': true,
                        'kode_pelanggan': kode_pelanggan,
                    },
                    success: function (response) {
                        // console.log(response);
                        if (response == 0) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Berhasil dihapus',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Data pelanggan tidak bisa di hapus',
                                text: 'Apabila pelanggan sudah tidak berlangganan lagi silahkan ubah status menjadi none',
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
    $('#submit_edit').click(function (e) {
        e.preventDefault();

        var kode = $('#id_edit').val();
        var nama = $('#nama_edit').val();
        var email = $('#email_edit').val();
        var email_user = $('#email_edit_user').val();
        var password = $('#password_edit').val();
        var nomer_hp = $('#nomer_hp_edit').val();
        var nama_produk = $('#pilihProduk_edit').val();
        var kodep = $('#kodep_edit').val();
        var status = $('#status').val();
        var mailformat = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

        $.ajax({
            type: "POST",
            url: "pelanggan/code.php",
            data: {
                'validasi_email_edit': true,
                'email_pelanggan': email,
                'email_pelanggan_user': email_user,
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
                        '' & nama_produk != '' &
                        kodep != '') {
                        if (email.match(mailformat)) {
                            $.ajax({
                                type: "POST",
                                url: "pelanggan/code.php",
                                data: {
                                    'checking_update': true,
                                    'kode_pelanggan': kode,
                                    'nama_pelanggan': nama,
                                    'email_pelanggan': email,
                                    'password': password,
                                    'nomer_hp': nomer_hp,
                                    'nama_produk': nama_produk,
                                    'kode_p': kodep,
                                    'status': status,
                                },
                                success: function (response) {
                                    // console.log(response);
                                    document.querySelector(".edit").classList
                                        .remove(
                                            "active");
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

function cek_edit() {
    $(document).on("click", "#btn-edit", function () {

        var kode_pelanggan = $(this).closest('tr').find('.pelanggan_id').text();
        // alert(stud_id);

        $.ajax({
            type: "POST",
            url: "pelanggan/code.php",
            data: {
                'checking_edit': true,
                'kode_pelanggan': kode_pelanggan,
            },
            success: function (response) {
                // console.log(response);
                $.each(response, function (key, value) {
                    // console.log(studview['fname']);
                    $('#id_edit').val(value['kode_pelanggan']);
                    $('#nama_edit').val(value['nama_pelanggan']);
                    $('#email_edit').val(value['email_pelanggan']);
                    $('#email_edit_user').val(value['email_pelanggan']);
                    $('#password_edit').val(value['password']);
                    $('#nomer_hp_edit').val(value['nomer_hp']);
                    $('#pilihProduk_edit').val(value['nama_produk']);
                    $('#kodep_edit').val(value['kode_produk']);
                    $('#status').val(value['status']);
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
                            <a href="#" id="btn-edit" class="aksi_pelanggan">\
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"\
                                style="fill: rgba(255, 212, 0, 1);">\
                                <path\
                                    d="M8.707 19.707 18 10.414 13.586 6l-9.293 9.293a1.003 1.003 0 0 0-.263.464L3 21l5.242-1.03c.176-.044.337-.135.465-.263zM21 7.414a2 2 0 0 0 0-2.828L19.414 3a2 2 0 0 0-2.828 0L15 4.586 19.414 9 21 7.414z">\
                                </path>\
                            </svg>\
                            </a>\
                            <a href="#" id="btn-hapus" class="aksi_pelanggan">\
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"\
                                style="fill: rgba(227, 71, 36, 1);">\
                                <path\
                                    d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm10.618-3L15 2H9L7.382 4H3v2h18V4z">\
                                </path>\
                            </svg>\
                            </a>\
                            </td>\
                        </tr><script>$(".aksi_pelanggan").hide();if(document.getElementById("level").value=="Super"){$(".aksi_pelanggan").show();}</' +
                    'script>');
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