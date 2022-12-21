<?php 
include '../koneksi.php';
$db = new Database();
$conn =  $db->db_connect();

$keyword = $_GET["keyword"];
$query= "SELECT * FROM pelanggan join produk on pelanggan.kode_produk = produk.kode_produk WHERE 
            `status` LIKE 'non aktif' AND
            nama_pelanggan LIKE '%$keyword%'";
$transaksi= query($query);
function query($sql) {
	global $conn;
	$result = mysqli_query($conn, $sql);

	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}

	return $rows;
}
?>
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
        <?php foreach( $transaksi as $row ) { ?>
        <tr>
            <td style="width: 10%;"><?= $row["kode_pelanggan"]; ?></td>
            <td style="width: 20%;"><?= $row["nama_pelanggan"]; ?></td>
            <td style="width: 20%;"><?= $row["nomer_hp"]; ?></td>
            <td style="width: 22%;"><?= $row["nama_produk"]; ?></td>
            <td style="width: 18%;"><?= $row["status"]; ?></td>
            <td style="width: 12%;">
                <a href="#" id="btn-bayar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"
                        style="fill: rgba(105, 172, 193, 1);">
                        <path
                            d="M12 15c-1.84 0-2-.86-2-1H8c0 .92.66 2.55 3 2.92V18h2v-1.08c2-.34 3-1.63 3-2.92 0-1.12-.52-3-4-3-2 0-2-.63-2-1s.7-1 2-1 1.39.64 1.4 1h2A3 3 0 0 0 13 7.12V6h-2v1.09C9 7.42 8 8.71 8 10c0 1.12.52 3 4 3 2 0 2 .68 2 1s-.62 1-2 1z">
                        </path>
                        <path d="M5 2H2v2h2v17a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4h2V2H5zm13 18H6V4h12z">
                    </svg>
                </a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>