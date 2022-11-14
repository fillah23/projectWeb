<?php 
$conn = mysqli_connect("localhost","root","","fans");

if(isset($_POST['checking_add']))
{
    $kode = $_POST['kode_akun'];
    $nama = $_POST['nama_akun'];
    $email = $_POST['email_akun'];
    $password = $_POST['password'];
    $password = md5($password);
    $level = $_POST['level'];
   

    $query = "INSERT INTO akun (kode_akun,nama_akun,email_akun, password, level ) VALUES ('$kode','$nama','$email','$password','$level')";
    $query_run = mysqli_query($conn, $query);
    function auto(){
        $conn = mysqli_connect("localhost","root","","fans");
    
        $num = '';
        $perfix = 'AA';
        $query = "SELECT MAX(kode_akun) AS kode from akun";
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
    $kode_akun = $_POST['kode_akun'];
    $result_array = [];

    $query = "SELECT * FROM akun WHERE kode_akun='$kode_akun' ";
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
    $kode = $_POST['kode_akun'];
    $nama = $_POST['nama_akun'];
    $email = $_POST['email_akun'];
    $password = $_POST['password'];
    $password = md5($password);
    $level = $_POST['level'];

    $query = "UPDATE akun SET nama_akun='$nama',email_akun='$email', password = '$password', level='$level' WHERE kode_akun='$kode'";
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
    $kode = $_POST['kode_akun'];

    $query = "DELETE FROM akun WHERE kode_akun='$kode' ";
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