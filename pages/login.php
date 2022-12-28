<?php 

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
			<form action="validasi.php" method="POST">
				<img src="../images/avatar.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Email</h5>
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
				<p><a href="../">kembali</a></p>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../js/main.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
<?php 

if(isset($_GET['email'])){
	if($_GET['email'] == "kosong"){
		echo "<script>
	Swal.fire({
				position: 'center',
				icon: 'warning',
				title: 'Email belum di masukkan',
				showConfirmButton: false,
				timer: 2000
			})
	</script>";
	}
}
if(isset($_GET['password'])){
	if($_GET['password'] == "kosong"){
		echo "<script>
	Swal.fire({
				position: 'center',
				icon: 'warning',
				title: 'Password belum di masukkan',
				showConfirmButton: false,
				timer: 2000
			})
	</script>";
	}
}
if(isset($_GET['login'])){
	if($_GET['login'] == "gagal"){
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
}

?>