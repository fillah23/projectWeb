<?php 
$conn = mysqli_connect("localhost","root","","fans");
$keyword = $_GET["keyword"];
$query= "SELECT * FROM produk WHERE 
            nama_produk LIKE '%$keyword%'";
function query($sql) {
	global $conn;
	$result = mysqli_query($conn, $sql);

	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}

	return $rows;
}
$produk= query($query);
?>
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
        <?php foreach( $produk as $row ) { ?>
        <tr>
            <td class="produk_id" style="width: 20%;"><?= $row["kode_produk"]; ?></td>
            <td style="width: 20%;"><?= $row["nama_produk"]; ?></td>
            <td style="width: 10%;"><?= $row["kecepatan"]; ?></td>
            <td style="width: 20%;"><?= $row["harga_produk"]; ?></td>
            <td style="width: 20%;"><?= $row["bandwith"]; ?></td>
            <td style="width: 10%;" class="aksi_produk">
                <a href="#" id="btn-edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                        style="fill: rgba(255, 212, 0, 1);">
                        <path
                            d="M8.707 19.707 18 10.414 13.586 6l-9.293 9.293a1.003 1.003 0 0 0-.263.464L3 21l5.242-1.03c.176-.044.337-.135.465-.263zM21 7.414a2 2 0 0 0 0-2.828L19.414 3a2 2 0 0 0-2.828 0L15 4.586 19.414 9 21 7.414z">
                        </path>
                    </svg>
                </a>
                <a href="#" id="btn-hapus">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                        style="fill: rgba(227, 71, 36, 1);">
                        <path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm10.618-3L15 2H9L7.382 4H3v2h18V4z">
                        </path>
                    </svg>
                </a>
            </td>
        </tr>
        <?php } ?>
        <script>$(".aksi_produk").hide();if(document.getElementById("level").value=="Super"){$(".aksi_produk").show();}</script>
    </tbody>
</table>