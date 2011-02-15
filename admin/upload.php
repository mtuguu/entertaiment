<?php
	$allowed_extensions = array(".jpg", ".jpeg", ".mp4");
	$upload_dir = "../uploads/audios/";
	//$upload_dir = 'upload/';
	
	if($_GET['action'] == 'upload'){
		$extension = strtolower(strrchr($_FILES['uploadfile']['name'], '.'));
		
		if (in_array($extension, $allowed_extensions) && 
				move_uploaded_file($_FILES['uploadfile']['tmp_name'], 
					$upload_dir.md5(basename($_FILES['uploadfile']['name'])).$extension
				)
		) {
			echo 'Successful';
		} else {
			echo 'UnSuccessful!\n';
		}
	}
	
?>
<form action="upload.php?action=upload" method="post"  enctype="multipart/form-data" name="form1" id="form1" >
	<input type="file" name="uploadfile" />
	<input type="submit" value="Submit"/>
</form>
