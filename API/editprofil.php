<?php 
$db = mysqli_connect('localhost','root','','fans');
if(!$db)
{
	echo "Database connection failed";
}
$email = $_POST['email'];
$email1 = $_POST['email_user'];
$nama = $_POST['nama'];
$hp = $_POST['hp'];
$kode=$_POST['kode_pelanggan'];

$sql = "SELECT email_pelanggan FROM pelanggan WHERE email_pelanggan='$email' AND NOT email_pelanggan='$email1'";
$result = mysqli_query($db,$sql);
$count = mysqli_num_rows($result);
if($count == 1){
	echo json_encode("Error");
}else{
	$insert = "UPDATE pelanggan SET nama_pelanggan ='$nama',email_pelanggan='$email',nomer_hp='$hp' WHERE kode_pelanggan='$kode'";
		$query = mysqli_query($db,$insert);
		if($query){
			echo json_encode("Success");
		}
}
?>