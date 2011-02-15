<?php
session_start();
include_once 'include/functions.php';
$user = new User();
$user->connect_db();
if ($user->get_session())
{
   header("location:home.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    $login = $user->check_login($_POST['emailusername'], $_POST['password']);
    if ($login) {
        // Нэвтрэлт амжилттай бол
       header("location:index.php");
    } else {
        // Нэвтрэлт амжилтгүй бол
        echo 'Хэрэглэгчийн нэр эсвэл нууц үг буруу байна!';
    }
}
?>
<html>
	<head>
		<!-- Meta -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!-- End of Meta -->
		
		<!-- Page title -->
		<title>Wide Admin - Login</title>
		<!-- End of Page title -->
		
		<!-- Libraries -->
		<link type="text/css" href="css/login.css" rel="stylesheet" />	
		<link type="text/css" href="css/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />	
		
		<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="js/easyTooltip.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
		<!-- End of Libraries -->	
	</head>
	<body>
	<div id="container">
		<div class="logo">
			<a href=""><img src="assets/logo.png" alt="" /></a>
		</div>
		<div id="box">
			<form method="POST" action=""  id="login_form" name="login">
			<div class="username">
			<p class="main">
				    <label>Хэрэглэгчийн нэр:</label>
					<input type="text" name="emailusername"  required="true" value="username" /> 
			</p>
			</div>
			<div class="password">
			<p class="main2">
				    <label>Нууц үг:</label>
					<input type="password" name="password" id="password" required="true" value="asdf1234">	
			<p>	
			</div>

			<p class="space">
				<input type="submit" value="Нэвтрэх" class="login" name="login_btn"  />
			</p>
			</form>
		</div>
	</div>

	</body>
</html>
