<?php
session_start();
include_once 'include/user.class.php';
include 'include/inc.editor.php';
include_once 'include/worktype.class.php';

$user = new User();
$user->connect_db();

$uid = $_SESSION['uid'];

$slc = new WorkType();


if (!$user->get_session())
{
   header("location:index.php");
}

if ($_GET['q'] == 'logout') 
{
    $user->user_logout();
    header("location:index.php");
}
$user->show_users();
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Meta -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!-- End of Meta -->
		
		<!-- Page title -->
		<title>Wide Admin</title>
		<!-- End of Page title -->
		
		<!-- Libraries -->
		<link type="text/css" href="css/layout.css" rel="stylesheet" />	
		
		<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="js/easyTooltip.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
		<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
		<script type="text/javascript" src="js/hoverIntent.js"></script>
		<script type="text/javascript" src="js/superfish.js"></script>
		<script type="text/javascript" src="js/custom.js"></script>
		
		<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
		<link rel="stylesheet" type="text/css" href="css/styles.css" />
		<!-- End of Libraries -->	
	</head>
	<body>
		<!-- Container -->
		<div id="container">
		
			<!-- Header -->
			<div id="header">
				
				<!-- Top -->
				<div id="top">
					<!-- Logo -->
					<div class="logo"> 
						<a href="#" title="Administration Home" class="tooltip"><img src="assets/logo.png" alt="Wide Admin" /></a> 
					</div>
					<!-- End of Logo -->
					
					<!-- Meta information -->
					<div class="meta">
						<p>Тавтай морил! <?php $user->get_fullname($uid); ?></p>
						<ul>
							<li><a href="?q=logout" title="Сайтын удирдлагын хэгээс гарах" class="tooltip"><span class="ui-icon ui-icon-power"></span>Гарах</a></li>
							<li><a href="#" title="Сонгогдсон тохиргоог өөрчлөх" class="tooltip"><span class="ui-icon ui-icon-wrench"></span>Тохиргоо</a></li>
							<li><a href="#" title="Өөрийн бүртгэлийг харах" class="tooltip"><span class="ui-icon ui-icon-person"></span>Миний бүртгэл</a></li>
						</ul>	
					</div>
					<!-- End of Meta information -->
				</div>
				<!-- End of Top-->
			
				<!-- The navigation bar -->
				<div id="navbar">
					<ul class="nav">
						<li><a href="home.php">Эхлэл</a></li>
						<li><a href="">Users</a></li>
						<li><a href="">Newsletter</a></li>
						<li><a href="">Modules</a></li>
						<li>
							<a href="">Multi Level Menu</a>
							<ul>
								<li><a href="">Menu Link 1</a></li>
								<li><a href="">Menu Link 2</a></li>
								<li><a href="">Menu Link 3</a>
									<ul>
										<li><a href="">Menu Link 1</a></li>
										<li><a href="">Menu Link 2</a>
											<ul>
												<li><a href="">Menu Link 1</a></li>
												<li><a href="">Menu Link 2</a></li>
												<li><a href="">Menu Link 3</a></li>
											</ul>
										</li>
										<li><a href="">Menu Link 3</a></li>
										<li><a href="">Menu Link 4</a></li>
										<li><a href="">Menu Link 5</a></li>
										<li><a href="">Menu Link 6</a></li>
									</ul>
								</li>
								<li><a href="">Menu Link 4</a></li>
								<li><a href="">Menu Link 5</a></li>
								<li><a href="">Menu Link 6</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<!-- End of navigation bar" -->
			</div>
			<!-- End of Header -->
			
			<!-- Background wrapper -->
			<div id="bgwrap">
		
				<!-- Main Content -->
				<div id="content">
					<div id="main">
					<h1>Тавтай морил, <span><?php $user->get_fullname($uid); ?></span>!</h1>
					<p>Өнөөдөр юу хийх гэж байна даа :D</p>
					<?php if($_GET['action'] == 'createDoneWork'): ?>
					<form action="test.php?action=createDoneWorkSave" method="post"  enctype="multipart/form-data" name="DoneWorkForm" id="DoneWorkForm" >
						<!-- Fieldset -->
						<fieldset>
							<legend>Хийж гүйцэтгэсэн ажлын талаар мэдээлэл оруулах/ Insert information about what work</legend>
<script type="text/javascript" >
	$(function(){
		var btnUpload=$('#upload');
		var status=$('#status');
		new AjaxUpload(btnUpload, {
			action: 'upload-file.php',
			name: 'uploadfile',
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					status.text('Зөвхөн JPG, PNG эсвэл GIF зургийн формат зөвшөөрөгдсөн.');
					return false;
				}
				status.text('Хуулж байж...');
			},
			onComplete: function(file, response){
				//On completion clear the status
				status.text('');
				//Add uploaded file to list
				if(response==="success"){
					$('<li></li>').appendTo('#files').html(file).addClass('success');
				} else{
					$('<li></li>').appendTo('#files').text(file).addClass('error');
				}
			}
		});
		
	});
</script>
							<p>
								<label for="lf">Гарчиг Монголоор </label>
								<input class="lf" name="mn_title" type="text" value="" /> <span class="validate_error"></span>
							</p>
							<p>
								<!-- WYSIWYG editor -->
								<textarea name="mn_desc" cols="200" style="width:100%" ></textarea>
								<!-- End of WYSIWYG editor -->
							</p>
							<p>
								<label for="lf">Тitle In English </label>
								<input class="lf" name="en_title" type="text" value="" /> <span class="validate_error"></span>
							</p>
							<p>
								<!-- WYSIWYG editor -->
								<textarea name="en_desc" cols="200" style="width:100%" style="display: inline;"></textarea>
								<!-- End of WYSIWYG editor -->
							</p>
							<p>
								<label>Public: </label>
								<input type="checkbox" name="active" />Нийтэд харуулах
							</p>
							<p>
								<label for="dropdown">Category: </label>
								<select name="type_id" class="dropdown">
									<option>Please select an option</option>
									<option>Upload</option>
									<option>Change</option>
									<option>Remove</option>
								</select>
							</p>
							<p>
								<label>Зураг / Image</label>
								<input type="file" name="uploadimage" />
								<input type="button" name="" value="Upload" class="button" />
							</p>
							<p>
								<label>MP3, MP4, FLV </label>
								<input type="file" name="uploadfile" />
								<input type="button" name="" value="Upload" class="button" />
							</p>
							<p>
								<?php echo $slc->selectBox; ?>
							</p>
							<p>
								<input class="button" type="submit" value="Submit" />
								<input class="button" type="reset" value="Reset" />
							</p>
						</fieldset>
						<!-- End of fieldset -->
					
					</form>
					<?php endif; ?>
					<?php
						if($_GET['action'] == 'editMenu')
							echo '<p class="sidebar">'.$slc->menuStructure.'</p>';
					?>
					<?php if(!isset($_GET['action'])): ?>
					<div class="pad20">
					<!-- Big buttons -->
						<ul class="dash">
							<li>
								<a href="#" title="Write a new article" class="tooltip">
									<img src="assets/icons/8_48x48.png" alt="" />
									<span>New article</span>
								</a>
							</li>
							<li>
								<a href="#" title="What your team posted" class="tooltip">
									<img src="assets/icons/7_48x48.png" alt="" />
									<span>Last articles</span>
								</a>
							</li>
							<li>
								<a href="#" title="Manage users and accounts" class="tooltip">
									<img src="assets/icons/16_48x48.png" alt="" />
									<span>Users</span>
								</a>
							</li>
							<li>
								<a href="home.php?action=createDoneWork" title="Хийсэн ажил оруулах" class="tooltip">
									<img src="assets/icons/20_48x48.png" alt="" />
									<span>Ажил оруулах</span>
								</a>
							</li>
							
							<li>
								<a href="#" title="Your site's statistics" class="tooltip">
									<img src="assets/icons/4_48x48.png" alt="" />
									<span>Statistics</span>
								</a>
							</li>
							<li>
								<a href="#" title="Bandwidth and traffic" class="tooltip">
									<img src="assets/icons/14_48x48.png" alt="" />
									<span>Bandwidth</span>
								</a>
							</li>
							<li>
								<a href="#" title="Server warnings" class="tooltip">
									<img src="assets/icons/5_48x48.png" alt="" />
									<span>Server warnings</span>
								</a>
							</li>
							<li>
								<a href="#" title="Lorem ipsum" class="tooltip">
									<img src="assets/icons/9_48x48.png" alt="" />
									<span>Listings</span>
								</a>
							</li>
							<li>
								<a href="#" title="Users' photo gallery" class="tooltip">
									<img src="assets/icons/1_48x48.png" alt="" />
									<span>Зургийн цомог</span>
								</a>
							</li>
							<li>
								<a href="#" title="0 new messages" class="tooltip">
									<img src="assets/icons/25_48x48.png" alt="" />
									<span>Inbox</span>
								</a>
							</li>
							<li>
								<a href="#" title="Browse for files" class="tooltip">
									<img src="assets/icons/21_48x48.png" alt="" />
									<span>File browser</span>
								</a>
							</li>
							<li>
								<a href="#" title="RSS Feeds" class="tooltip">
									<img src="assets/icons/29_48x48.png" alt="" />
									<span>Feeds</span>
								</a>
							</li>
							<li>
								<a href="home.php?action=editMenu" title="Lorem ipsum" class="tooltip">
									<img src="assets/icons/20_48x48.png" alt="" />
									<span>Ангилал</span>
								</a>
							</li>
							<li>
								<a href="#" title="Lorem ipsum" class="tooltip">
									<img src="assets/icons/26_48x48.png" alt="" />
									<span>Latest comments</span>
								</a>
							</li>
						</ul>
						<!-- End of Big buttons -->
					</div>
						<?php endif; ?>
					</div>
					
				</div>
				<!-- End of Main Content -->
				
				<!-- Sidebar -->
				<div id="sidebar">
					<h2>Datepicker</h2>
					<!-- Datepicker -->
					<div id="datepicker"></div>
					<!-- End of Datepicker -->
				</div>
				<!-- End of Sidebar -->
				
			</div>
			<!-- End of bgwrap -->
		</div>
		<!-- End of Container -->
		
		<!-- Footer -->
		<div id="footer">
			<p class="mid">
				<a href="#" title="Top" class="tooltip">Top</a>&middot;<a href="home.php" title="Эхлэл" class="tooltip">Эхлэл</a>&middot;<a href="#" title="Change current settings" class="tooltip">Settings</a>&middot;<a href="?q=logout" title="Гарах" class="tooltip">Гарах</a>
			</p>
			<p class="mid">
				<!-- Change this to your own once purchased -->
				&copy; Creative Open Systems 2011.
				<!-- -->
			</p>
		</div>
		<!-- End of Footer -->
	</body>
</html>
