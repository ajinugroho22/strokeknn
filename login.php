<!-- Gambar Pojok -->
<?php
session_start();
if(!isset($_SESSION['login'])){  
    $_SESSION['login']="";
  }
if ($_SESSION['login']=="admin"){
	header('Location: dashboard.php');
	exit;
  }
  
include'./control/data_admin.php';
$adm = new dataadmin();

//jika menekan tombol Login
if(isset($_POST['submit']))
{
    $user = $_POST['username'];
    $pass = $_POST['password'];    
	$pass=md5($pass);

	$akses=$adm->cekdata($user,$pass);
    if(!empty($akses)){
		foreach ($akses as $as) {
			$_SESSION['username']=$as['username'];
			$_SESSION['password']=$as['password'];
		}
	   
       $_SESSION['login']="admin";
    //    header("location: dashboard.php");
	}
	else{
		echo "<script>alert('Gagal Masuk')</script>";
    	header("location: login.php");
	}
    // else {
    //     echo "<script>alert('Gagal Masuk')</script>";
    //     header("location: login.php");
    // }
}
?>
<img class="wave" src="assets/img/pojok.png">
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="assets/img/logo.png">
	<title>Login</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
	<div class="container">
		<!-- Gambar kiri -->
		<div class="img">
			<img src="assets/img/bglogin.png">
		</div>
		<div class="login-content">
			<!-- Form Login -->
			<form id="form1" name="form1" method="POST">
				<img src="assets/img/logo.png">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<input required name="username" id="username" placeholder="Username" type="text" class="input">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<input required name="password" id="password" placeholder="Password" type="password" class="input">  
					</div>
            	</div>
            	<input name="submit" type="submit" class="btn" value="Login">
			</form>
			<!-- End Form Login -->
        </div>
    </div>
    <script src="assets/plugins/jquery/jquery.min.js"></script>
</body>
</html>