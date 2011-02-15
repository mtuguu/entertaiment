<?php
	include('include/config.php');
	
	class DoneWorks {
		var $conn;
		var $db_error_msg; 
		
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
		
		function Insert($type_id, $mn_title, $en_title, $mn_desc, $en_desc, $image, $file, $active){
			$query = "INSERT INTO done_works (type_id, mn_title, en_title, mn_desc, en_desc, image, file, active) 
			VALUES($type_id, $mn_title, $en_title, $mn_desc, $en_desc, $image, $file, $active)";
			$result = mysql_query($query);
			if(!$result)
				$this->db_error_msg .= mysql_error();
		}
		
		
		function get_done_work($id){
			$query = "SELECT * FROM done_works WHERE id = ".$id;
			$result = mysql_query($query);
			$result = mysql_fetch_row($result);
			
			$this->type_id = $result['type_id'];
			$this->en_title = $result['en_title'];
			$this->mn_title = $result['mn_title'];
			$this->en_desc = $result['en_desc'];
			$this->mn_desc = $result['mn_desc'];
			$this->image = $result['image'];
			$this->file = $result['file'];
			$this->active = $result['active'];
			$this->created_at = $result['created_at'];
			$this->updated_at = $result['updated_at'];
		}
		
		function get_done_works(){
			$query = "SELECT * FROM done_works";
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
		function getVideo(){
			$vid = new Video();
			//$rv = $vid->
		}
	} 
?>
