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
?>
<main>
    <!-- table -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>
                    Pelanggan
                </h2>
                <a href="#" id="show-login" class="btn" onclick="bg()">Tambah</a>
            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                        <td>Pelanggan</td>
                        <td>Nama</td>
                        <td>nomer hp</td>
                        <td>status</td>
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
                <input type="text" id="kode" name="kode" placeholder="Masukkan kode" value="<?= auto(); ?>" readonly>
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
                <label for="status">Status</label>
                <input type="text" id="status" name="status" placeholder="Masukkan Status" autocomplete="off">
            </div>
            <div class="form-element">
                <label for="nama_produk" >Nama Produk</label>
                <select name="pilihProduk" id="pilihProduk">
                <option>==Pilih barang==</option>
                <?php while($data=mysqli_fetch_array($query)){?>
                <option data-harga="<?= $data['harga_produk']; ?>" data-kode="<?= $data['kode_produk']; ?>"><?php echo $data['nama_produk'];?></option>
                <?php } ?>
                </select>
            </div>
            <div class="form-element">
                <input type="text" id="kode_produk" name="kode_produk" placeholder="Masukkan kode produk" readonly>
            </div>
            <div class="form-element">
                <input type="text" id="harga" name="harga" placeholder="Masukkan kode harga" readonly>
            </div>
            <div class="form-element">
                <input type="hidden" id="tanggal" name="tanggal" placeholder="Masukkan Tanggal" readonly>
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
                <label for="harga">Harga</label>
                <input type="text" id="harga_edit" placeholder="Masukkan Harga"
                    onkeypress="return onlyNumberKey(event)">
            </div>
            <div class="form-element">
                <label for="stok">Stok</label>
                <input type="text" id="stok_edit" placeholder="Masukkan Stok" onkeypress="return onlyNumberKey(event)">
            </div>
            <div class="form-element">
                <button id="edit_button">Edit</button>
            </div>
        </div>
    </div>
</main>
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
            var harga = $('#harga_edit').val();
            var stok = $('#stok_edit').val();

            if (nama != '' & harga != '' & stok != '') {
                $.ajax({
                    type: "POST",
                    url: "produk/code.php",
                    data: {
                        'checking_update': true,
                        'kode_produk': kode,
                        'nama_produk': nama,
                        'harga_produk': harga,
                        'stok': stok,
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
                        $('#stok_edit').val(value['stok']);
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
                        '<td class="produk_id" style="width: 20%;">' + value['kode_pelanggan'] + '</td>\
                                <td style="width: 25%;">' + value['nama_pelanggan'] + '</td>\
                                <td style="width: 25%;">' + value['nomer_hp'] + '</td>\
                                <td style="width: 20%;">' + value['status'] + '</td>\
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
            var harga = $('#harga').val();
            var stok = $('#stok').val();

            if (kode != '' & nama != '' & harga != '' & stok != '') {
                $.ajax({
                    type: "POST",
                    url: "produk/code.php",
                    data: {
                        'checking_add': true,
                        'kode_produk': kode,
                        'nama_produk': nama,
                        'harga_produk': harga,
                        'stok': stok,
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
    $('#pilihProduk').on('change', function(){
  // ambil data dari elemen option yang dipilih
  const harga = $('#pilihProduk option:selected').data('harga');
  const kode = $('#pilihProduk option:selected').data('kode');
  
  // tampilkan data ke element
  $('[name=harga]').val(harga);
  $('[name=kode_produk]').val(kode);
  

});
</script>