<?php 
include "../koneksi.php";
session_start();
if(!isset($_SESSION["login"])){
	header("Location: ../login.php");
	exit;
}
function auto(){
    // $conn = mysqli_connect("localhost","root","","fans");
    $db = new Database();
    $conn =  $db->db_connect();

    $num = '';
    $perfix = 'PL';
    // $query = "SELECT MAX(kode_pelanggan) AS kode from pelanggan";
    $query_run = $conn->query("SELECT MAX(kode_pelanggan) AS kode from pelanggan");
    $data = mysqli_fetch_array($query_run);
    $row = mysqli_fetch_row($query_run);
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
// $conn = mysqli_connect("localhost","root","","fans");
$db = new Database();
$conn =  $db->db_connect();

// $perintah="select * from produk order by kode_produk ASC";
// $query=mysqli_query($conn,$perintah);
$query= $conn->query("SELECT * from produk order by kode_produk ASC");

$query_edit=$conn->query("SELECT * from produk order by kode_produk ASC");
// $query_edit=mysqli_query($conn,$perintah);
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
                value="<?php echo date("Y/m/d") ?>" readonly>
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
            <input type="hidden" id="email_edit_user" name="email" placeholder="Masukkan Email" autocomplete="off">
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
                <option>none</option>
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
<input type="text" name="" id="level" value="Admin" hidden>
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
<script src="pelanggan/functions.js">
    
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

    $(document).ready(function () {
        $('#search_pelanggan').on('keyup', function () {
            $('#table-pelanggan').load('pelanggan/search.php?keyword=' + $('#search_pelanggan').val());
        });
    });
</script>
<script>
    var x = sessionStorage.getItem("textvalue3");
    var decrypted = CryptoJS.AES.decrypt(x, "Secret Passphrase");
    document.getElementById("level").value = decrypted.toString(CryptoJS.enc.Utf8);
</script>