<?php
include_once 'include/functions.php';
$user = new User();
$user->connect_db();
// Checking for user logged in or not
if ($user->get_session())
{
header("location:home.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
$register = $user->register_user($_POST['username'], $_POST['userpass'], $_POST['mail'], $_POST['active'], $_POST['created_at'], $_POST['updated_at']);
if ($register) 
{
// Registration Success
echo 'Registration successful <a href="index.php">Click here</a> to login';
} else 
{
// Registration Failed
echo 'Registration failed. Email or Username already exits please try again';
}
}
?>
<html>
	<head></head>
	<body>
<form method="POST" action="register.php" name='reg' >
Username
<input type="text" name="username"/>
Password
<input type="password" name="userpass"/>
Email
<input type="text" name="mail"/>
<input
<input type="submit" value="Register"/>
</form>
	</body>
</html>
