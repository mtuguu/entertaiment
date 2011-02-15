<?php
	include("include/config.php");
	$conn = new DB_Class();
	
	if(!$conn)
		echo "DB CONNECTION ERROR IN AUDIO CLASS";
	
	public class Audio {
		var $allowed_extensions = array(".mp3");
		
		
	}
?>
