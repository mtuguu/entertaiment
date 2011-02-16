<?php 
include_once 'config.php';

class Album {
	// DB_Class шинэ объект үүсгэж байна
	public function connect_db()
	{
		$db = new DB_Class();
	}

	public function save($mn_name, $en_name, $mn_desc, $en_desc)
	{
		$mn_name = htmlspecialchars($mn_name);
		$en_name = htmlspecialchars($en_name);
		$mn_desc = htmlspecialchars($mn_desc);
		$en_desc = htmlspecialchars($en_desc);
		
		$sql = mysql_query(sprintf("INSERT INTO album(mn_name, en_name, mn_desc, en_desc, created_at, updated_at) values ('%s','%s','%s','%s','%s','%s')", $mn_name, $en_name, $mn_desc, $en_desc, date('Y-m-d H:m:s'), date('Y-m-d H:m:s'))) or die(mysql_error());
		if($sql)
		{ 
			return true;
		}
		else 
		{ 
			return false; 
		}

	}
}
