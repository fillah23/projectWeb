<?php 
function auto(){
    $conn = mysqli_connect("localhost","root","","fans");

    $num = '';
    $perfix = 'AA';
    $query = "SELECT MAX(kode_akun) AS kode from akun";
    $run = mysqli_query($conn,$query);
    $data = mysqli_fetch_array($run);
    $row = mysqli_fetch_row($run);
    $num = $data['kode'];
    $number = (int)substr($num,2,5);
    $number++;

    if($row > 0){
        return 'kode telah digunakan';
    }else{
        $value = $perfix.sprintf("%05s",$number);
    }
    return $value;

}
?>
    <!-- table -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>
                    Pengaturan Akun
                </h2>
                <a href="#" id="show-login" class="btn" onclick="bg()">Tambah</a>
            </div>
            <div id="table-akun" class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <td>Kode Akun</td>
                            <td>Nama</td>
                            <td>Email</td>
                            <td>Level</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody class="tabel">
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="popup">
        <div class="close-btn">&times;</div>

        <div class="form">
            <h2>Tambah Data</h2>
            <div class="form-element">
                <!-- <label for="kode">kode</label> -->
                <input type="text" id="kode" name="kode" placeholder="Masukkan kode" value="<?= auto(); ?>" readonly>
            </div>
            <div class="form-element">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" autocomplete="off">
            </div>
            <div class="form-element">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Masukkan Email" autocomplete="off">
            </div>
            <div class="form-element">
                <label for="password">Password</label>
                <input type="text" id="password" name="password" placeholder="Masukkan Password" autocomplete="off">
            </div>
            <div class="form-element">
                <label for="level">Level</label>
                <!-- <input type="text" id="level" placeholder="Masukkan Level" autocomplate = "off"> -->
                <select name="level" id="level">
                <option>==Pilih level==</option>
                <option>Admin</option>
                <option>Super</option>
                </select>
            </div>
            
            <div class="form-element">
                <button type="button" id="submit">Tambah</button>
            </div>
        </div>


    </div>
    <div class="edit">
        <div class="close-btn" id="close-edit">&times;</div>
        <div class="form">
            <h2>Edit Data</h2>
            <input type="hidden" name="" id="id_edit">
            <div class="form-element">
                <label for="nama">Nama</label>
                <input type="text" id="nama_edit" placeholder="Masukkan Nama">
            </div>
            <div class="form-element">
                <label for="email">Email</label>
                <input type="text" id="email_edit" placeholder="Masukkan Email">
            </div>
            <div class="form-element">
                <label for="password">Password</label>
                <input type="text" id="password_edit" placeholder="Masukkan Password">
            </div>
            <div class="form-element">
                <label for="level">Level</label>
                <!-- <input type="text" id="level_edit" placeholder="Masukkan Level"> -->
                <select name="level_edit" id="level_edit">
                <option>==Pilih level==</option>
                <option>Admin</option>
                <option>Super</option>
                </select>
            </div>
            <div class="form-element">
                <button id="edit_button">Edit</button>
            </div>
        </div>
    </div>

<script>
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
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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
            var level = $('#level_edit').val();
            var password = $('#password_edit').val();


            if (nama != '' & email != '' &password != '' & level != '') {
                $.ajax({
                    type: "POST",
                    url: "akun/code.php",
                    data: {
                        'checking_update': true,
                        'kode_akun': kode,
                        'nama_akun': nama,
                        'email_akun': email,
                        'password':password,
                        'level': level
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
                        $('#level_edit').val(value['level']);
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
            var level = $('#level').val();
            var password = $('#password').val();

            if (kode != '' & nama != '' & email != '' & password !='' & level != '' ) {
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
                    title: 'Lengkapi data',
                    showConfirmButton: false,
                    timer: 2000
                })
            }

        });
    }

    $(document).ready(function(){
    $('#search_akun').on('keyup',function(){
    $('#table-akun').load('akun/search.php?keyword=' +$('#search_akun').val());
    });
    });
</script>