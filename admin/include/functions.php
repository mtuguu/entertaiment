<?php

include_once 'config.php';

class User {

// DB_Class шинэ объект үүсгэж байна
public function connect_db() 
{
        $db = new DB_Class();
}
	
// Хэрэглэгч бүртгэх функц   
public function register_user($name, $username, $password, $email) 
{
        $password = md5($password);
		$username = mysql_real_escape_string($username);
		$email = mysql_real_escape_string($email);
		$name = mysql_real_escape_string($name);

		$sql = mysql_query(sprintf("SELECT uid from users WHERE username = '%s' or email = '%s'", $username, $email));
        $no_rows = mysql_num_rows($sql);
		
		if ($no_rows == 0) 
		{
        
		$result = mysql_query(sprintf("INSERT INTO users(username, password, name, email) values ('%s', '%s','%s','%s')",$username, $password, $name, $email)) or die(mysql_error());
        return $result;
		}
		else
		{
		return FALSE;
		}
		
    }
	// Хэрэглэгч нэвтэрсэн эсэхийг шалгаж байгаа хэсэг
	public function check_login($emailusername, $password) 
	{
		$password = md5($password);
		$emailusername = mysql_real_escape_string($emailusername);
        $result = mysql_query(sprintf("SELECT uid from users WHERE email = '%s' or username='%s' and password = '%s'", $emailusername, $emailusername, $password));
        $user_data = mysql_fetch_array($result);
        $no_rows = mysql_num_rows($result);
		
        if ($no_rows == 1) 
		{
     
            $_SESSION['login'] = true;
            $_SESSION['uid'] = $user_data['uid'];
            return TRUE;
        }
        else
		{
		    return FALSE;
		}
	}
	//Хэрэглэгчдийг харуулдаг функц
	public function show_users() 
	{
		$result = mysql_query("SELECT username, name, email FROM users");
	    return $user_info = mysql_fetch_array($result);
	}
	// Хэрэглэгчийн бүтэн нэрийг шүүж гаргаж ирж байгаа функц
    public function get_fullname($uid) 
	{
        $result = mysql_query("SELECT name FROM users WHERE uid = $uid");
        $user_data = mysql_fetch_array($result);
        echo $user_data['name'];
    }
  
	// Хэрэглэгчид session үүсгэж байгаа функц
    public function get_session() 
	{
        return $_SESSION['login'];
    }
	// Хэрэглэгчийн session устгаж байгаа функц
    public function user_logout() {
        $_SESSION['login'] = FALSE;
        session_destroy();
    }
}
?>
