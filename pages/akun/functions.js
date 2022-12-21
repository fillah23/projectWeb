//Popup
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

function onlyNumberKey(evt) {
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}  

// textfild angka
$(document).ready(function () {
    getdata();
    addData();
    cek_edit();
    editData();
    hapus();
});

function hapus() {
    $(document).on("click", "#btn-hapus", function () {

        var kode_akun = $(this).closest('tr').find('.akun_id').text();
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
                    url: "akun/code.php",
                    data: {
                        'checking_delete': true,
                        'kode_akun': kode_akun,
                    },
                    success: function (response) {
                        // console.log(response);
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

            }
        });


    });
}

function editData() {
    $('#edit_button').click(function (e) {
        e.preventDefault();

        var kode = $('#id_edit').val();
        var nama = $('#nama_edit').val();
        var email = $('#email_edit').val();
        var email_user = $('#email_edit_user').val();
        var level = $('#idlevel_edit').val();
        var password = $('#password_edit').val();
        var mailformat = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

        $.ajax({
            type: "POST",
            url: "akun/code.php",
            data: {
                'validasi_email_edit': true,
                'email_akun': email,
                'email_akun_user': email_user,
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
                    if (kode != '' & nama != '' & email != '' & password != '' & level != '') {
                        if (email.match(mailformat)) {
                            $.ajax({
                                type: "POST",
                                url: "akun/code.php",
                                data: {
                                    'checking_update': true,
                                    'kode_akun': kode,
                                    'nama_akun': nama,
                                    'email_akun': email,
                                    'password': password,
                                    'level': level
                                },
                                success: function (response) {
                                    // console.log(response);
                                    document.querySelector(".edit").classList
                                        .remove("active");
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
                                    $('#password_edit').val("");
                                    getdata();

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

function cek_edit() {
    $(document).on("click", "#btn-edit", function () {

        var kode_akun = $(this).closest('tr').find('.akun_id').text();
        // alert(stud_id);

        $.ajax({
            type: "POST",
            url: "akun/code.php",
            data: {
                'checking_edit': true,
                'kode_akun': kode_akun,
            },
            success: function (response) {
                // console.log(response);
                $.each(response, function (key, value) {
                    // console.log(studview['fname']);
                    $('#id_edit').val(value['kode_akun']);
                    $('#nama_edit').val(value['nama_akun']);
                    $('#email_edit').val(value['email_akun']);
                    $('#email_edit_user').val(value['email_akun']);
                    $('#pilihlevel_edit').val(value['level']);
                    $('#idlevel_edit').val(value['id_level']);
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
        url: "akun/fetch.php",
        success: function (response) {
            // console.log(response);
            $.each(response, function (key, value) {
                // console.log(value['fname']);
                $('.tabel').append('<tr>' +
                    '<td class="akun_id" style="width: 20%;">' + value['kode_akun'] + '</td>\
                            <td style="width: 25%;">' + value['nama_akun'] + '</td>\
                            <td style="width: 25%;">' + value['email_akun'] + '</td>\
                            <td style="width: 20%;">' + value['level'] + '</td>\
                            <td style="width: 10%;">\
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
        var level = $('#idlevel').val();
        var password = $('#password').val();
        var mailformat = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

        $.ajax({
            type: "POST",
            url: "akun/code.php",
            data: {
                'validasi_email': true,
                'email': email,
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
                    if (kode != '' & nama != '' & email != '' & password != '' & level != '') {
                        if (email.match(mailformat)) {
                            $.ajax({
                                type: "POST",
                                url: "akun/code.php",
                                data: {
                                    'checking_add': true,
                                    'kode_akun': kode,
                                    'nama_akun': nama,
                                    'email_akun': email,
                                    'password': password,
                                    'level': level
                                },
                                success: function (response) {
                                    // console.log(response);
                                    document.querySelector(".popup").classList
                                        .remove(
                                            "active");
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
                                    $('#level').val("");
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

$(document).ready(function () {
    $('#search_akun').on('keyup', function () {
        $('#table-akun').load('akun/search.php?keyword=' + $('#search_akun').val());
    });
});

$('#pilihlevel').on('change', function () {
    // ambil data dari elemen option yang dipilih
    const nama = $('#pilihlevel option:selected').data('nama');

    // tampilkan data ke element
    $('[name=idlevel]').val(nama);
});
$('#pilihlevel_edit').on('change', function () {
    // ambil data dari elemen option yang dipilih
    const nama = $('#pilihlevel_edit option:selected').data('nama');

    // tampilkan data ke element
    $('[name=idlevel_edit]').val(nama);
});