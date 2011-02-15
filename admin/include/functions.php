<?php

include_once 'config.php';
session_start();
class User {

// DB_Class шинэ объект үүсгэж байна
public function connect_db() 
{
        $db = new DB_Class();
}
	
// Хэрэглэгч бүртгэх функц   
public function register_user($username, $userpass, $mail, $active, $created_at, $updated_at) 
{
        $userpass = md5($userpass);
		$username = mysql_real_escape_string($username);
		$email = mysql_real_escape_string($email);
		$name = mysql_real_escape_string($name);

		$sql = mysql_query(sprintf("SELECT id from user WHERE username = '%s' or mail = '%s'", $username, $email));
        $no_rows = mysql_num_rows($sql);
		
		if ($no_rows == 0) 
		{
        
		$result = mysql_query(sprintf("INSERT INTO user(username, userpass, mail, active, created_at, updated_at) values ('%s', '%s','%s','%s','%s','%s')",$username, $userpass, $mail, $active, date('Y-m-d H:m:s'), date('Y-m-d H:m:s'))) or die(mysql_error());
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
        $result = mysql_query(sprintf("SELECT id from user WHERE mail = '%s' or username='%s' and userpass = '%s'", $emailusername, $emailusername, $password));
        $user_data = mysql_fetch_row($result);
        $no_rows = mysql_num_rows($result);
		
        if ($no_rows == 1) 
		{
     
            $_SESSION['login'] = true;
            $_SESSION['uid'] = $user_data['username'];
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
        $result = mysql_query("SELECT username FROM user WHERE id = $uid");
        $user_data = mysql_fetch_array($result);
        echo $user_data[0];
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
