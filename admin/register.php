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
$register = $user->register_user($_POST['name'], $_POST['username'], $_POST['password'], $_POST['email']);
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
Full Name
<input type="text" name="name"/>
Username
<input type="text" name="username"/>
Password
<input type="password" name="password"/>
Email
<input type="text" name="email"/>
<input type="submit" value="Register"/>
</form>
	</body>
</html>
