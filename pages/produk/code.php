<?php 
// $conn = mysqli_connect("localhost","root","","fans");
include '../koneksi.php';
$db = new Database();
$conn =  $db->db_connect();
// $query_run = $conn->query("select * from produk");

if(isset($_POST['checking_add']))
{
    $kode = $_POST['kode_produk'];
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga_produk'];
    $stok = $_POST['stok'];
    $kecepatan = $_POST['kecepatan'];

    $query_run = $conn->query("INSERT INTO produk (kode_produk,nama_produk,harga_produk,bandwith,kecepatan) VALUES ('$kode','$nama','$harga','$stok','$kecepatan')");
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

    // $query = "SELECT * FROM produk WHERE kode_produk='$kode_produk' ";
    $query_run = $conn->query("SELECT * FROM produk WHERE kode_produk='$kode_produk'");

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

    $query_run = $conn->query("UPDATE produk SET nama_produk='$nama',harga_produk='$harga',bandwith='$stok',kecepatan='$kecepatan' WHERE kode_produk='$kode'");

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

    $query_run = $conn->query("DELETE FROM produk WHERE kode_produk='$kode'");

    if($query_run)
    {
        echo $return  = 0;
    }
    else
    {
        echo $return  = 1;
    }
}
?>