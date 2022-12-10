<?php 
session_start();
$conn = mysqli_connect("localhost","root","","fans");


if(isset($_SESSION["login"])){
	header("Location: ../pages");
	exit;
}
if(isset($_POST["login"])){
    $username=$_POST["email"];
    $password=$_POST["password"];
    $result=mysqli_query($conn,"SELECT * FROM `akun` JOIN level_akun ON akun.id_level =level_akun.id_level WHERE email_akun='$username'");

    if(mysqli_num_rows($result )=== 1){
        $row= mysqli_fetch_assoc($result);
		$nama_akun=$row['nama_akun'];
		$level=$row['level'];
		$kode_akun=$row['kode_akun'];
        if(password_verify($password,$row["password"])){
            $_SESSION["login"] = true;
			$_SESSION['nama_akun'] = $nama_akun;
			$_SESSION['level'] = $level;
			$_SESSION['kode_akun'] = $kode_akun;
            header("Location: ../pages");
            exit;
        }
    }
    $error=true;
	
}
$email = $_POST['email'];
$password = $_POST['password'];
if($email == ""){
	header("location:login.php?email=kosong");
}
else if($password == ""){
	header("location:login.php?password=kosong");
}else{
    header("location:login.php?login=gagal");
}
?>