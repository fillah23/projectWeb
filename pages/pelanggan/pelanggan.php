<?php 
function auto(){
    $conn = mysqli_connect("localhost","root","","fans");

    $num = '';
    $perfix = 'PL';
    $query = "SELECT MAX(kode_pelanggan) AS kode from pelanggan";
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
$conn = mysqli_connect("localhost","root","","fans");
$perintah="select * from produk order by kode_produk ASC";
$query=mysqli_query($conn,$perintah);

$query_edit=mysqli_query($conn,$perintah);
?>

<!-- table -->
<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>
                Pelanggan
            </h2>
            <a href="#" id="show-login" class="btn">Tambah</a>
        </div>
        <div id="table-pelanggan" class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nama</td>
                        <td>Nomer hp</td>
                        <td>Produk</td>
                        <td>Status</td>
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
            <input type="hidden" id="kode" name="kode" placeholder="Masukkan kode" value="<?= auto(); ?>" readonly>
        </div>
        <div class="form-element">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" autocomplete="off">
        </div>
        <div class="form-element">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Masukkan Email" autocomplete="off">
        </div>
        <div class="form-element">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan Password" autocomplete="off">
        </div>
        <div class="form-element">
            <label for="nomer_hp">Nomer HP</label>
            <input type="text" id="nomer_hp" name="nomer_hp" placeholder="Masukkan Nomer HP" autocomplete="off"
                onkeypress="return onlyNumberKey(event)">
        </div>
        <div class="form-element">
            <label for="nama_produk">Nama Produk</label>
            <select name="pilihProduk" id="pilihProduk">
                <option>==Pilih barang==</option>
                <?php while($data=mysqli_fetch_array($query)){?>
                <option data-nama="<?= $data['kode_produk']; ?>">
                    <?php echo $data['nama_produk'];?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-element">
            <input type="hidden" id="nama_produk" name="nama_produk" placeholder="Masukkan nama produk" readonly>
        </div>
        <div class="form-element">
            <input type="hidden" id="tanggal" name="tanggal" placeholder="Masukkan Tanggal"
                value="<?php echo date("Y-m-d") ?>" readonly>
        </div>
        <div class="form-element">
            <button type="button" id="submit" class="button">Tambah</button>
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
            <input type="text" id="nama_edit" name="nama" placeholder="Masukkan Nama" autocomplete="off">
        </div>
        <div class="form-element">
            <label for="email">Email</label>
            <input type="email" id="email_edit" name="email" placeholder="Masukkan Email" autocomplete="off">
        </div>
        <div class="form-element">
            <label for="password">Password</label>
            <input type="password" id="password_edit" name="password" placeholder="Masukkan Password"
                autocomplete="off">
        </div>
        <div class="form-element">
            <label for="nomer_hp">Nomer HP</label>
            <input type="text" id="nomer_hp_edit" name="nomer_hp" placeholder="Masukkan Nomer HP" autocomplete="off"
                onkeypress="return onlyNumberKey(event)">
        </div>
        <div class="form-element">
            <label for="">Status</label>
            <select name="" id="status">
                <option>aktif</option>
                <option>non aktif</option>
            </select>
        </div>
        <div class="form-element">
            <label for="nama_produk">Nama Produk</label>
            <select name="pilihProduk_edit" id="pilihProduk_edit">
                <?php while($data_edit=mysqli_fetch_array($query_edit)){?>
                <option data-nama="<?= $data_edit['kode_produk']; ?>">
                    <?php echo $data_edit['nama_produk'];?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-element">
            <input type="hidden" id="kodep_edit" name="kodep_edit" placeholder="Masukkan kode harga" readonly>
        </div>
        <div class="form-element">
            <button type="button" id="submit_edit" class="button">Edit</button>
        </div>
    </div>
</div>
<div class="view">
    <div class="close-btn">&times;</div>
    <div class="form">
        <h2>Lihat Data</h2>
        <div class="form-element">
            <p class="id_view" hidden></p>
            <label for="">Nama :</label>
            <p><span class="nama_view"></span></p>

        </div>
        <div class="form-element">
            <label for="">Email :</label>
            <p><span class="email_view"></span></p>
        </div>
        <div class="form-element">
            <label for="">Password : </label>
            <p><span class="password_view"></span></p>
        </div>
        <div class="form-element">
            <label for="">Nomer hp : </label>
            <p><span class="nomer_hp_view"></span></p>
        </div>
        <div class="form-element">
            <label for="">Status : </label>
            <p><span class="status_view"></span></p>
        </div>
        <div class="form-element">
            <label for="">Produk : </label>
            <p><span class="nama_produk_view"></span></p>
        </div>
        <div class="form-element">
            <label for="">Harga : </label>
            <p><span class="harga_view"></span></p>
        </div>
        <div class="form-element">
            <label for="">Tanggal berlangganan : </label>
            <p><span class="tanggal_view"></span></p>
        </div>
    </div>
</div>
<input type="text" name="" id="level"value="Admin" hidden>
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
    document.querySelector(".view .close-btn").addEventListener("click", function () {
        document.querySelector(".view").classList.remove("active");
        $(".view").css({
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
        $('#submit_edit').click(function (e) {
            e.preventDefault();

            var kode = $('#id_edit').val();
            var nama = $('#nama_edit').val();
            var email = $('#email_edit').val();
            var password = $('#password_edit').val();
            var nomer_hp = $('#nomer_hp_edit').val();
            var nama_produk = $('#pilihProduk_edit').val();
            var kodep = $('#kodep_edit').val();
            var status = $('#status').val();

            if (kode != '' & nama != '' & email != '' & password != '' & nomer_hp != '' & nama_produk != '' &
                kodep != '') {
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
                                <td style="width: 18%;">' + value['status'] + '</td>\
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
                            </tr><script>$(".aksi_pelanggan").hide();if(document.getElementById("level").value=="Super"){$(".aksi_pelanggan").show();}</' + 'script>');
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

            if (kode != '' & nama != '' & email != '' & password != '' & nomer_hp != '' & nama_produk != '' ) {
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
                    title: 'Lengkapi data',
                    showConfirmButton: false,
                    timer: 2000
                })
            }

        });
    }
</script>
<script>
    $('#pilihProduk').on('change', function () {
        // ambil data dari elemen option yang dipilih
        const nama = $('#pilihProduk option:selected').data('nama');

        // tampilkan data ke element
        $('[name=nama_produk]').val(nama);
    });
    $('#pilihProduk_edit').on('change', function () {
        // ambil data dari elemen option yang dipilih
        const nama = $('#pilihProduk_edit option:selected').data('nama');

        // tampilkan data ke element
        $('[name=kodep_edit]').val(nama);
    });

    $(document).ready(function(){
    $('#search_pelanggan').on('keyup',function(){
    $('#table-pelanggan').load('pelanggan/search.php?keyword=' +$('#search_pelanggan').val());
    });
    });
</script>
<script>
    var x = sessionStorage.getItem("textvalue3");
    var decrypted = CryptoJS.AES.decrypt(x, "Secret Passphrase");
    document.getElementById("level").value= decrypted.toString(CryptoJS.enc.Utf8);
</script>