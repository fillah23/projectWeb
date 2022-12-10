<?php
$conn = mysqli_connect("localhost","root","","fans");
if(isset($_POST["From"], $_POST["to"]))
{
    $result = '';
    $query = "SELECT * FROM pelanggan join produk on pelanggan.kode_produk = 
    produk.kode_produk join transaksi on pelanggan.kode_pelanggan = transaksi.kode_pelanggan 
    join akun on transaksi.kode_akun = akun.kode_akun WHERE 
                tanggal_transaksi BETWEEN '".$_POST["From"]."' AND '".$_POST["to"]."'";
    $sql = mysqli_query($conn, $query);
    $result .='
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
    <tbody class="tabel">';
    if(mysqli_num_rows($sql) > 0)
    {
        while($row = mysqli_fetch_array($sql))
        {
            $result .='
            <tr>
        <td class="riwayat_id" >'.$row['kode_transaksi'].'</td>
                                <td>'.$row['nama_pelanggan'].'</td>
                                <td>'.$row['nama_produk'].'</td>
                                <td>'.$row['tanggal_transaksi'].'</td>
                                <td>'.$row['kecepatan'].'</td>
                                <td>'.$row['bandwith'].'</td>
                                <td>'.$row['nama_akun'].'</td>
                                <td>'.$row['harga_produk'].'</td>
        </tr>';
        }
    }
    else
    {
        $result .='
        <tr>
        <td colspan="5">Data tidakditemukan</td>
        </tr>';
    }
    $result .='</tbody>';
    $result .='</table>';
    echo $result;
}
?>