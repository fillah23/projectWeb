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
//List functions
$(document).ready(function () {
    getdata();
    addData();
    cek_edit();
    editData();
    hapus();
});

function hapus() {
    $(document).on("click", "#btn-hapus", function () {

        var id = $(this).closest('tr').find('.faq_id').text();
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
                    url: "faq/code.php",
                    data: {
                        'checking_delete': true,
                        'id': id,
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
        var pertanyaan = $('#pertanyaan_edit').val();
        var jawaban = $('#jawaban_edit').val();

        if (pertanyaan != '' & jawaban != '') {
            $.ajax({
                type: "POST",
                url: "faq/code.php",
                data: {
                    'checking_update': true,
                    'id_faq': kode,
                    'pertanyaan': pertanyaan,
                    'jawaban': jawaban,
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

        var id = $(this).closest('tr').find('.faq_id').text();
        // alert(stud_id);

        $.ajax({
            type: "POST",
            url: "faq/code.php",
            data: {
                'checking_edit': true,
                'id': id,
            },
            success: function (response) {
                // console.log(response);
                $.each(response, function (key, value) {
                    // console.log(studview['fname']);
                    $('#id_edit').val(value['id']);
                    $('#pertanyaan_edit').val(value['pertanyaan']);
                    $('#jawaban_edit').val(value['jawaban']);
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
        url: "faq/fetch.php",
        success: function (response) {
            // console.log(response);
            $.each(response, function (key, value) {
                // console.log(value['fname']);
                $('.tabel').append('<tr>' +
                    '<td class="faq_id" style="width: 20%;">' + value['id'] + '</td>\
                            <td style="width: 25%;">' + value['pertanyaan'] + '</td>\
                            <td style="width: 25%;">' + value['jawaban'] + '</td>\
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

        
        var pertanyaan = $('#pertanyaan').val();
        var jawaban = $('#jawaban').val();


        if ( jawaban != '' &  pertanyaan!= '') {
            $.ajax({
                type: "POST",
                url: "faq/code.php",
                data: {
                    'checking_add': true,
                    'pertanyaan': pertanyaan,
                    'jawaban': jawaban,
                    
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
                        title: response,
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $('.tabel').html("");
                    getdata();
                    $('#pertanyaan').val("");
                    $('#jawaban').val("");
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

$(document).ready(function(){
$('#search_faq').on('keyup',function(){
$('#table-faq').load('faq/search.php?keyword=' +$('#search_faq').val());
});
});