<?php 
session_start();
$conn = mysqli_connect("localhost","root","","fans");

if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id=$_COOKIE['id'];
    $key=$_COOKIE['key'];

    $result =mysqli_query($conn,"SELECT email_akun FROM akun WHERE kode_akun = $id ");
    $row=mysqli_fetch_assoc($result);
    if($key === hash('sha256',$row['email_akun'])){
        $_SESSION['login']=true;
    }
}

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
        if(password_verify($password,$row["password"])){
            $_SESSION["login"] = true;
            if(isset($_POST['remember'])){
                setcookie('id',$row['kode_akun'],time()+60);
                setcookie('key',hash('sha256',$row['email_akun']),time()+60);
            }
			$_SESSION['nama_akun'] = $nama_akun;
			$_SESSION['level'] = $level;
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
				<?php if(isset($error) ) :?>
    <p><?= $error; ?></p>
    <?php endif; ?>
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
            	<input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            	<input type="submit" class="btn" value="Login" name="login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../js/main.js"></script>
</body>
</html>
