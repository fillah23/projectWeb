<?php
$connect = new mysqli("localhost", "root", "", "fans");
$kode = $_POST["kode_pelanggan"];
$queryResult=$connect->query("SELECT * FROM pelanggan join produk on pelanggan.kode_produk = 
produk.kode_produk join transaksi on pelanggan.kode_pelanggan = transaksi.kode_pelanggan 
join akun on transaksi.kode_akun = akun.kode_akun where pelanggan.kode_pelanggan ='".$kode."'");
$result=array();
while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}
echo json_encode($result);
?>