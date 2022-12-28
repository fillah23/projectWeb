<?php 
include 'db.php';
if(!$db)
{
	echo "Database connection failed";
}

$kode = $_POST['kode'];
$password = $_POST['password'];

$edit = "UPDATE pelanggan SET password ='$password' WHERE kode_pelanggan='$kode'";
$query = mysqli_query($db,$edit);
if($query){
    echo json_encode("Success");
}
?>