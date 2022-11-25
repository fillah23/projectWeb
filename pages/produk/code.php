<?php 
$conn = mysqli_connect("localhost","root","","fans");

if(isset($_POST['checking_add']))
{
    $kode = $_POST['kode_produk'];
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga_produk'];
    $stok = $_POST['stok'];
    $kecepatan = $_POST['kecepatan'];

    $query = "INSERT INTO produk (kode_produk,nama_produk,harga_produk,stok,kecepatan) VALUES ('$kode','$nama','$harga','$stok','$kecepatan')";
    $query_run = mysqli_query($conn, $query);
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
    if($query_run)
    {
        echo $return  = auto();
    }
    else
    {
        echo $return  = "Something Went Wrong.!";
    }
}

if(isset($_POST['checking_edit']))
{
    $kode_produk = $_POST['kode_produk'];
    $result_array = [];

    $query = "SELECT * FROM produk WHERE kode_produk='$kode_produk' ";
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
if(isset($_POST['checking_update']))
{
    $kode = $_POST['kode_produk'];
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga_produk'];
    $stok = $_POST['stok'];
    $kecepatan = $_POST['kecepatan'];

    $query = "UPDATE produk SET nama_produk='$nama',harga_produk='$harga',stok='$stok',kecepatan='$kecepatan' WHERE kode_produk='$kode'";
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
if(isset($_POST['checking_delete']))
{
    $kode = $_POST['kode_produk'];

    $query = "DELETE FROM produk WHERE kode_produk='$kode' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        echo $return  = "Berhasil di hapus";
    }
    else
    {
        echo $return  = "Something Went Wrong.!";
    }
}
?>