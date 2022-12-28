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
    $perfix = 'PD';
    // $query = "SELECT MAX(kode_produk) AS kode from produk";
    // $run = mysqli_query($conn,$query);
    $query_run = $conn->query("SELECT MAX(kode_produk) AS kode from produk");
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
?>
<!-- table -->
<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>
                Produk
            </h2>
            <a href="#" id="show-login" class="btn" onclick="bg()">Tambah</a>
        </div>
        <div id="table-produk" class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nama</td>
                        <td>Kecepatan</td>
                        <td>Harga</td>
                        <td>Bandwith</td>
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
            <input type="hidden" id="kode" name="kode" placeholder="Masukkan kode" value="<?= auto(); ?>" readonly>
        </div>
        <div class="form-element">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" autocomplete="off">
        </div>
        <div class="form-element">
            <label for="kecepatan">Kecepatan</label>
            <input type="text" id="kecepatan" name="kecepatan" placeholder="Masukkan kecepatan" autocomplete="off"
                onkeypress="return onlyNumberKey(event)">
        </div>

        <div class="form-element">
            <label for="harga">Harga</label>
            <input type="text" id="harga" name="harga" placeholder="Masukkan Harga" autocomplete="off"
                onkeypress="return onlyNumberKey(event)">
        </div>
        <div class="form-element">
            <label for="stok">Bandwith</label>
            <input type="text" id="stok" name="stok" placeholder="Masukkan Stok" autocomplete="off">
        </div>
        <div class="form-element">
            <button type="button" id="submit" class="button">Tambah</button>
        </div>
    </div>
</div>
<input type="text" name="" id="level" value="Admin" hidden>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="produk/functions_admin.js"></script>