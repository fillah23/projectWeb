<?php 
include '../koneksi.php';
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
    $perfix = 'TR';
    // $query = "SELECT MAX(kode_transaksi) AS kode from transaksi";
    $query_run = $conn->query("SELECT MAX(kode_transaksi) AS kode from transaksi");
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
<div class="details">
  <div class="recentOrders">
    <div class="cardHeader">
      <h2>
        Transaksi
      </h2>
    </div>
    <div id="table-transaksi" class="table-wrapper">
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
    <div class="form-element">
      <h2>Apakah Yakin ingin bayar?</h2>
      <button class="button" type="button" id="submit"
        onclick="struk3(); struk4(); window.open('transaksi/struk.html','_blank'); ">Bayar</button>
    </div>
  </div>
</div>
<input type="hidden" id="id_akun">
<input type="hidden" value="<?php echo auto() ?>" id="idbarang">
<input type="hidden" value="<?php echo date("Y-m-d") ?>" id="tanggal">
<input type="hidden" id="harga_barang">
<input type="hidden" id="barang">
<input type="hidden" id="id_pelanggan">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="transaksi/functions.js"></script>
</script>
<!-- <script>
 
</script>
<script>
  
</script> -->