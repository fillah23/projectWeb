<?php 
$conn = mysqli_connect("localhost","root","","fans");
if(isset($_POST['checking_bayar']))
{
    $id = $_POST['id'];
    $result_array = [];

    $query = "SELECT * FROM pelanggan WHERE kode_pelanggan='$id' ";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) > 0)
    {
        foreach($query_run as $row)
        {
            array_push($result_array, $row);
        }
        header('Content-type: application/json');
        echo json_encode($result_array);
    }
    else
    {
        echo $return = "No Record Found.!";
    }
}
if(isset($_POST['checking_add']))
{
    $id = $_POST['id'];
    $tanggal = $_POST['tanggal'];
    $harga_barang = $_POST['harga_barang'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $barang = $_POST['barang'];
    $idakun = $_POST['idakun'];
    
    $query = "INSERT INTO 
    transaksi (kode_transaksi,tanggal_transaksi,total,kode_akun,kode_pelanggan,nama_produk) 
    VALUES ('$id','$tanggal','$harga_barang','$idakun','$id_pelanggan','$barang')";
    $query_run = mysqli_query($conn, $query);

    
    
    if($query_run)
    {
        echo $return  = "";
    }
    else
    {
        echo $return  = "Something Went Wrong.!";
    }
}
if(isset($_POST['checking_add_detail']))
{
    $id = $_POST['id'];
    $tanggal = $_POST['tanggal'];
    $harga_barang = $_POST['harga_barang'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $barang = $_POST['barang'];
    $idakun = $_POST['idakun'];
    
    $query = "INSERT INTO 
    detail_transaksi (kode_transaksi,tanggal,harga_produk,nama_admin,nama_pelanggan,nama_produk) 
    VALUES ('$id','$tanggal','$harga_barang','$idakun','$id_pelanggan','$barang')";
    $query_run = mysqli_query($conn, $query);
    function auto(){
        $conn = mysqli_connect("localhost","root","","fans");
    
        $num = '';
        $perfix = 'TR';
        $query = "SELECT MAX(kode_transaksi) AS kode from detail_transaksi";
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
    
    if($query_run)
    {
        echo $return  = auto();
    }
    else
    {
        echo $return  = "Something Went Wrong.!";
    }
}

if(isset($_POST['checking_update']))
{
    $kode = $_POST['id'];
    $tanggal = $_POST['tanggal'];

    $query ="UPDATE pelanggan SET `status`='aktif', tanggal_berlangganan='$tanggal' WHERE kode_pelanggan='$kode'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        echo $return  = "Berhasil di edit";
    }
    else
    {
        echo $return  = "Something Went Wrong.!";
    }
}
?>