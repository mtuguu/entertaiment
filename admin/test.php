<?php
	include("./include/doneworks.class.php");
	//echo date("Y - m - d - H - m - s");
	echo "Hello World";
	$work = new DoneWorks();
	$work->ConnDB();
	
	$mn_title = $_POST['mn_title'];
	$mn_desc = $_POST['mn_desc'];
	$en_title = $_POST['en_title'];
	$en_desc = $_POST['en_desc'];
	$active = $_POST['active']
	$work->Insert(1, $mn_title, $en_title, $mn_desc, $en_desc, 1, 1, $active);
	
	echo $work->db_error_msg;
?>
