<?php
	include('include/config.php');
	
	class DoneWorks {
		var $conn;
		var $lang;
		var $en_title;
		var $mn_title;
		var $en_desc;
		var $mn_desc;
		var $image;
		var $file;
		var $allowed_extensions = array();
		var $active;
		var $created_at;
		var $updated_at;
		
		function ConnDB(){
			$this->conn = new DB_Class();
		}
		
		function Register(){
			
		}
		
		function get_done_work($id){
			$query = "";
		}
		
		function get_done_works(){
			$query = "SELECT * R";
		}
		
	}
	
	class Audio extends DoneWorks{
		var $allowed_extensions;
		
		function __construct(){
			$this->allowed_extensions = array(".mp3");
		}
	}
	 class Video extends DoneWorks{
		var $allowed_extensions;
		
		function __construct(){
			$this->allowed_extensions = array(".flv", ".mp4");
		}
	} 
?>
