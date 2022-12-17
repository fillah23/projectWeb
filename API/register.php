<?php
$db = mysqli_connect('localhost','root','','fans');
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
if(!$db)
{
	echo "Database connection failed";
}
$email = $_POST['email'];
$password = $_POST['password'];
$nama = $_POST['nama'];
$hp = $_POST['hp'];

$sql = "SELECT email_pelanggan FROM pelanggan WHERE email_pelanggan = '".$email."'";
$result = mysqli_query($db,$sql);
$count = mysqli_num_rows($result);
if($count == 1){
	echo json_encode("Error");
}else{
	$insert = "INSERT INTO pelanggan(kode_pelanggan,kode_produk,status,email_pelanggan,password,nama_pelanggan,nomer_hp) VALUES ('".auto()."','PD00001','none','".$email."','".$password."','".$nama."','".$hp."')";
		$query = mysqli_query($db,$insert);
		if($query){
			echo json_encode("Success");
		}
}
?>