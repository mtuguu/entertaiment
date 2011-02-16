<?php
	include('include/config.php');
	
	class DoneWorks {
		var $conn;
		var $db_error_msg; 
		
		var $lang;
		
		var $id;
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
			$this->db = new DB_Class();
			$this->conn = $this->db->db_conn;
			$this->db_error_msg = '';
		}
		
		function Insert($type_id, $mn_title, $en_title, $mn_desc, $en_desc, $image, $file, $active){
			$query = sprintf("INSERT INTO done_works 
				(type_id, mn_title, en_title, mn_desc, en_desc, image, file, active, created_at, updated_at) 
			VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', now(), now())", 
				$type_id, $mn_title, $en_title, $mn_desc, $en_desc, $image, $file, $active);
			$result = mysql_query($query, $this->conn);
			if(!$result)
				$this->db_error_msg .= mysql_error();
			else $this->db_error_msg = "Success";
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
			$result_array = array();
			
			$result = mysql_query($query);
			
			if(!$result)
				$this->db_error_msg .= mysql_error();
				
			while($line = mysql_fetch_row($result)){
				$temp_obj = new DoneWorks();
				
				$temp_obj->id = $line['id'];
				$temp_obj->type_id = $result['type_id'];
				$temp_obj->en_title = $result['en_title'];
				$temp_obj->mn_title = $result['mn_title'];
				$temp_obj->en_desc = $result['en_desc'];
				$temp_obj->mn_desc = $result['mn_desc'];
				$temp_obj->image = $result['image'];
				$temp_obj->file = $result['file'];
				$temp_obj->active = $result['active'];
				$temp_obj->created_at = $result['created_at'];
				$temp_obj->updated_at = $result['updated_at'];
				array_push($result_array, $temp_obj);
			}
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
