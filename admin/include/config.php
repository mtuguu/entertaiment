<?php
/* Баазын тохиргоог энд хийж өгч байна */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'enter_data');

class DB_Class {
	/* Баазтай холбогдох функц */
	var $db_conn;
    function __construct() {
		// Баазтай холболт үүгэж байна 
        $connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die('Oops connection error -> ' . mysql_error());
        mysql_select_db(DB_DATABASE, $connection) or die('Database error -> ' . mysql_error());
        mysql_set_charset($connection, "UTF8");
        $this->db_conn = $connection;
    }
	
}
?>
