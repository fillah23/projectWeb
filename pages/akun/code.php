<?php 
// $conn = mysqli_connect("localhost","root","","fans");
include '../koneksi.php';
$db = new Database();
$conn =  $db->db_connect();
// $query_run = $conn->query("select * from akun");

if(isset($_POST['validasi_email']))
{
    $email = $_POST['email'];
    $result_array = [];

    $query_run = $conn->query("SELECT * FROM `akun` JOIN level_akun ON akun.id_level =level_akun.id_level WHERE email_akun='$email' ");
    $num = mysqli_num_rows($query_run);

    if($num>0)
    {
        echo 0;
    }
    else
    {
        echo 1;
    }
}
if(isset($_POST['validasi_email_edit']))
{
    $email_akun = $_POST['email_akun'];
    $email_akun_user = $_POST['email_akun_user'];
    $result_array = [];

    $query_run = $conn->query("SELECT * FROM `akun` JOIN level_akun ON akun.id_level =level_akun.id_level WHERE email_akun='$email_akun' AND NOT email_akun='$email_akun_user'");
    $num = mysqli_num_rows($query_run);

    if($num>0)
    {
        echo 0;
    }
    else
    {
        echo 1;
    }
}
if(isset($_POST['checking_add']))
{
    $kode = $_POST['kode_akun'];
    $nama = $_POST['nama_akun'];
    $email = $_POST['email_akun'];
    $password = $_POST['password'];
    $password = password_hash($password,PASSWORD_DEFAULT);
    $level = $_POST['level'];
   

    // $query = "INSERT INTO akun (kode_akun,nama_akun,email_akun, password, id_level ) VALUES ('$kode','$nama','$email','$password','$level')";
    $query_run = $conn->query("INSERT INTO akun (kode_akun,nama_akun,email_akun, password, id_level ) VALUES ('$kode','$nama','$email','$password','$level')");

    function auto(){
        // $conn = mysqli_connect("localhost","root","","fans");
        $db = new Database();
        $conn =  $db->db_connect();

        $num = '';
        $perfix = 'AA';
        // $query = "SELECT MAX(kode_akun) AS kode from akun";
        // $run = mysqli_query($conn,$query);
        $query_run = $conn->query("SELECT MAX(kode_akun) AS kode from akun");
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
    $kode_akun = $_POST['kode_akun'];
    $result_array = [];

    // $query = "SELECT * FROM `akun` JOIN level_akun ON akun.id_level =level_akun.id_level WHERE kode_akun='$kode_akun' ";
    $query_run = $conn->query("SELECT * FROM `akun` JOIN level_akun ON akun.id_level =level_akun.id_level WHERE kode_akun='$kode_akun'");

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
    $kode = $_POST['kode_akun'];
    $nama = $_POST['nama_akun'];
    $email = $_POST['email_akun'];
    $password = $_POST['password'];
    $password = password_hash($password,PASSWORD_DEFAULT);
    $level = $_POST['level'];

    // $query = "UPDATE akun SET nama_akun='$nama',email_akun='$email', password = '$password', id_level='$level' WHERE kode_akun='$kode'";
    $query_run = $conn->query("UPDATE akun SET nama_akun='$nama',email_akun='$email', password = '$password', id_level='$level' WHERE kode_akun='$kode'");

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
    $kode = $_POST['kode_akun'];

    // $query = "DELETE FROM akun WHERE kode_akun='$kode' ";
    $query_run = $conn->query("DELETE FROM akun WHERE kode_akun='$kode'");

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