<?php 
session_start();
$conn = mysqli_connect("localhost","root","","fans");

if(isset($_SESSION["login"])){
	header("Location: home.php");
	exit;
}
if(isset($_POST["login"])){
    $username=$_POST["email"];
    $password=$_POST["password"];
    $result=mysqli_query($conn,"SELECT * FROM akun WHERE email_akun='$username'");

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
            header("Location: home.php");
            exit;
        }
    }
    $error=true;
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="../css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="../images/wave.png">
	<div class="container">
		<div class="img">
			<img src="../images/bg.svg">
		</div>
		<div class="login-content">
			<form action="" method="POST">
				<img src="../images/avatar.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input" name="email">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" name="password">
            	   </div>
            	</div>
            	<input type="submit" class="btn" value="Login" name="login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../js/main.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
<?php 
if(isset($error) ){
	echo "<script>
	Swal.fire({
				position: 'center',
				icon: 'warning',
				title: 'Email / Password salah',
				showConfirmButton: false,
				timer: 2000
			})
	</script>";
}
?>