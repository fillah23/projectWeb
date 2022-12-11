<?php 
session_start();
if(!isset($_SESSION["login"])){
	header("Location: ../login.php");
	exit;
}
function auto(){
    $conn = mysqli_connect("localhost","root","","fans");

    $num = '';
    $perfix = 'PD';
    $query = "SELECT MAX(kode_produk) AS kode from produk";
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
                        <td class="aksi_produk">Aksi</td>
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
            <input type="text" id="kecepatan" name="kecepatan" placeholder="Masukkan kecepatan" autocomplete="off" onkeypress="return onlyNumberKey(event)">
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
            <label for="kecepatan">Kecepatan</label>
            <input type="text" id="kecepatan_edit" placeholder="Masukkan kecepatan" onkeypress="return onlyNumberKey(event)">
        </div>

        <div class="form-element">
            <label for="harga">Harga</label>
            <input type="text" id="harga_edit" placeholder="Masukkan Harga" onkeypress="return onlyNumberKey(event)">
        </div>
        <div class="form-element">
            <label for="stok">Bandwith</label>
            <input type="text" id="stok_edit" placeholder="Masukkan Stok" >
        </div>
        <div class="form-element">
            <button id="edit_button" class="button">Edit</button>
        </div>
    </div>
</div>
<input type="text" name="" id="level"value="Admin" hidden >
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="produk/functions.js"></script>
