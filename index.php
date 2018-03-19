<?php
	function __autoload($className) {
	$file = strtolower($className).'.php';
	echo $file;
	if(file_exists($file)) {
		require_once $file;
	}
	}
	
	$privilege;
	if(isset($_COOKIE['user'])&&!empty($_COOKIE['user'])&&isset($_COOKIE['pass'])&&!empty($_COOKIE['pass'])){
		$user_name = strtolower($_COOKIE['user']);
		$password = $_COOKIE['pass'];
		login($user_name, $password);
	}
	if(isset($_GET['user_name'])&&!empty($_GET['user_name'])&&isset($_GET['password'])&&!empty($_GET['password'])){
		$user_name = strtolower($_GET['user_name']);
		$password = $_GET['password'];
		login($user_name, $password);
	}
	
	function login($user, $pass){
		global $privilege;
		$user_name = $user;
		$password = $pass;

		$mydb = mysqli_connect("localhost", "root", "", "sea") or die("Something wrong with the server, try again later.");
		$privilege = mysqli_fetch_array(mysqli_query($mydb, "SELECT privilege FROM user_list WHERE user_name = '$user_name' and password = '$password'"));
		
		if (!empty($privilege[0])){
			setcookie('user', $user_name, time() + (86400 * 30), "/");
			setcookie('pass', $password, time() + (86400 * 30), "/");
			session_start();
			switch(strtolower($privilege[0])){
				case 'student':
					$_SESSION['user'] = new Student($user_name);
				break;
				case 'instructor':
					$_SESSION['user'] = new Instructor($user_name);
				break;
				case 'lecturer':
					$_SESSION['user'] = new Lecturer($user_name);
				break;
				
				case 'admin':
					$_SESSION['user'] = new Admin($user_name);
				break;
			}
			gotouserhome();
		}
	}
	
	function gotouserhome(){
		global $privilege;
		header("Location:	".$privilege[0]."_home.php");
		exit;
	}
?>
<!DOCTYPE html>

<html lang="en">
<head>
	<title>Login V15</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100" style="background-image: url(images/background.jpg);background-repeat:no-repeat;background-size:cover;">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/u.jpg);">
					<span class="login100-form-title-1">
						Sign In
					</span>
				</div>

				<form class="login100-form validate-form" form action = "index.php"	method = "GET">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="user_name" placeholder="Enter username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type = "submit">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>