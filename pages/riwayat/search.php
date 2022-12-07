<?php 
$conn = mysqli_connect("localhost","root","","fans");
$keyword = $_GET["keyword"];
$query= "SELECT * FROM pelanggan join produk on pelanggan.kode_produk = 
produk.kode_produk join transaksi on pelanggan.kode_pelanggan = transaksi.kode_pelanggan 
join akun on transaksi.kode_akun = akun.kode_akun WHERE 
            nama_pelanggan LIKE '%$keyword%'";
function query($sql) {
	global $conn;
	$result = mysqli_query($conn, $sql);

	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}

	return $rows;
}
$faq= query($query);
?>
<table>
    <thead>
        <tr>
        <td>Id</td>
                        <td>Pelanggan</td>
                        <td>Produk</td>
                        <td>Tanggal</td>
                        <td>Kecepatan</td>
                        <td>Bandwith</td>
                        <td>Admin</td>
                        <td>Harga</td>
        </tr>
    </thead>
    <tbody class="tabel">
        <?php foreach( $faq as $row ) { ?>
        <tr>
        <td class="riwayat_id" > <?= $row['kode_transaksi']; ?></td>
                                <td> <?= $row['nama_pelanggan']; ?></td>
                                <td> <?= $row['nama_produk']; ?></td>
                                <td> <?= $row['tanggal_transaksi']; ?></td>
                                <td> <?= $row['kecepatan']; ?></td>
                                <td> <?= $row['bandwith']; ?></td>
                                <td> <?= $row['nama_akun']; ?></td>
                                <td> <?= $row['harga_produk']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>