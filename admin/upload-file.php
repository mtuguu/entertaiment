<?php
$uploaddir = './uploads/'; 
$extention =  strtolower(strrchr($_FILES['uploadfile']['name'], '.'));
$date = date('YmdHms'); 
$file = $uploaddir . md5(basename($_FILES['uploadfile']['name'])).$date.$extention; 
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) { 
  echo "success"; 
} else {
	echo "error";
}
?>
