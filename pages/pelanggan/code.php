<?php 
$conn = mysqli_connect("localhost","root","","fans");

if(isset($_POST['checking_add']))
{
    $kode = $_POST['kode_pelanggan'];
    $nama = $_POST['nama_pelanggan'];
    $email_pelanggan = $_POST['email_pelanggan'];
    $password = $_POST['password'];
    $nomer_hp = $_POST['nomer_hp'];
    $nama_produk = $_POST['nama_produk'];
    $tanggal_berlangganan = $_POST['tanggal_berlangganan'];

    $query = "INSERT INTO pelanggan 
    (kode_pelanggan,nama_pelanggan,email_pelanggan,
    `password`,nomer_hp,`status`,kode_produk,tanggal_berlangganan) 
    VALUES ('$kode','$nama','$email_pelanggan','$password','$nomer_hp',
    'non aktif','$nama_produk','$tanggal_berlangganan')";
    $query_run = mysqli_query($conn, $query);
    function auto(){
        $conn = mysqli_connect("localhost","root","","fans");

        $num = '';
        $perfix = 'PL';
        $query = "SELECT MAX(kode_pelanggan) AS kode from pelanggan";
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
    $kode_pelanggan = $_POST['kode_pelanggan'];
    $result_array = [];

    $query = "SELECT * FROM pelanggan join produk on pelanggan.kode_produk = produk.kode_produk WHERE kode_pelanggan='$kode_pelanggan' ";
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
    $kode = $_POST['kode_pelanggan'];
    $nama = $_POST['nama_pelanggan'];
    $email_pelanggan = $_POST['email_pelanggan'];
    $password = $_POST['password'];
    $nomer_hp = $_POST['nomer_hp'];
    $nama_produk = $_POST['nama_produk'];
    $kode_p = $_POST['kode_p'];
    $status = $_POST['status'];

    $query = "UPDATE pelanggan SET nama_pelanggan='$nama',email_pelanggan='$email_pelanggan',
    `password`='$password',nomer_hp='$nomer_hp',kode_produk='$kode_p',
    `status`='$status' WHERE kode_pelanggan='$kode'";
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
    $kode = $_POST['kode_pelanggan'];

    $query = "DELETE FROM pelanggan WHERE kode_pelanggan='$kode' ";
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

if(isset($_POST['checking_view']))
{
    $kode = $_POST['kode_pelanggan'];
    $result_array = [];

    $query = "SELECT * FROM pelanggan join produk on pelanggan.kode_produk = produk.kode_produk WHERE kode_pelanggan='$kode' ";
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
?>