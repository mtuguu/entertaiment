<?php
session_start();
include_once 'include/user.class.php';
include 'include/inc.editor.php';
$user = new User();
$user->connect_db();

$uid = $_SESSION['uid'];

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
		
		<script type="text/javascript" src="js/ jquery-1.3.2.js" ></script>
		<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
		<link rel="stylesheet" type="text/css" href="./styles.css" />
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
						<li><a href="">Dashboard</a></li>
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
				
				<!-- Search bar -->
				<div id="search">
					<form action="/search/" method="POST">
						<p>
							<input type="submit" value="" class="but" />
							<input type="text" name="q" value="Search the admin panel" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
						</p>
					</form>
				</div>
				<!-- End of Search bar -->
			
			</div>
			<!-- End of Header -->
			
			<!-- Background wrapper -->
			<div id="bgwrap">
		
				<!-- Main Content -->
				<div id="content">
					<div id="main">
					<h1>Тавтай морил! <span><?php $user->get_fullname($uid); ?></span>!</h1>
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
								<input class="button" type="submit" value="Submit" />
								<input class="button" type="reset" value="Reset" />
							</p>
						</fieldset>
						<!-- End of fieldset -->
					
					</form>
					<?php endif; ?>
					
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
							<!--
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
								<a href="#" title="Manage downloads" class="tooltip">
									<img src="assets/icons/3_48x48.png" alt="" />
									<span>Downloads</span>
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
									<span>Gallery</span>
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
								<a href="#" title="Calculator" class="tooltip">
									<img src="assets/icons/30_48x48.png" alt="" />
									<span>Calculator</span>
								</a>
							</li>
							<li>
								<a href="#" title="RSS Feeds" class="tooltip">
									<img src="assets/icons/29_48x48.png" alt="" />
									<span>Feeds</span>
								</a>
							</li>
							<li>
								<a href="#" title="Lorem ipsum" class="tooltip">
									<img src="assets/icons/20_48x48.png" alt="" />
									<span>Media</span>
								</a>
							</li>
							<li>
								<a href="#" title="Lorem ipsum" class="tooltip">
									<img src="assets/icons/26_48x48.png" alt="" />
									<span>Latest comments</span>
								</a>
							</li>-->
						</ul>
						<!-- End of Big buttons -->
					</div>
				
					
					<hr />
					
					<h1>Notifications</h1>
					<div class="pad20">
						<p>Wide Admin provides some nice graphics and effects for custom notification messages. Clicking on one message will make it disappear! This is optional, of course!</p>
						<div class="message success close">
							<h2>Congratulations!</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vulputate ligula est, ut facilisis magna. Quisque vitae est sapien. Etiam in diam ipsum. Etiam condimentum euismod eleifend. Lorem! Vestibulum quis turpis eu justo porta tincidunt.</p>
						</div>
						<div class="message warning close">
							<h2>Warning!</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vulputate ligula est, ut facilisis magna. Quisque vitae est sapien. Etiam in diam ipsum. Etiam condimentum euismod eleifend. Vivamus gravida nunc in augue accumsan vitae pharetra tellus pretium. Vestibulum non mauris in nunc dictum faucibus.</p>
						</div>
						<div class="message error close">
							<h2>Error!</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vulputate ligula est, ut facilisis magna. Quisque vitae est sapien. Etiam in diam ipsum. Etiam condimentum euismod eleifend. Vestibulum quis turpis eu justo porta tincidunt. </p>
						</div>
						<div class="message information close">
							<h2>Information</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vulputate ligula est, ut facilisis magna. Quisque vitae est sapien. Etiam in diam ipsum. Etiam condimentum euismod eleifend. Lorem! Vestibulum quis turpis eu justo porta tincidunt.</p>
						</div>
					</div>
			
					<hr />
								
					<h1>Three columns, sortable content</h1>
					<div class="pad20">
					
						<!-- Three columns content -->
						<div id="columns" class="sortable">
						
							<!-- Column one -->
							<div class="cols3 column">
								<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
									<div class="portlet-header">Dummy content 1</div>
									<div class="portlet-content">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu orci quam, vitae molestie nulla. Etiam tempus suscipit imperdiet. Nam vitae purus neque, nec placerat dui. Aenean tristique sapien metus. Mauris tempus arcu vel sapien tristique vitae sagittis nisi hendrerit.</p>	
									</div>
								</div>
							</div>
							<!-- End of Column one -->
							
							<!-- Column two -->
							<div class="cols3 column">
								<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
									<div class="portlet-header">Dummy content 2</div>
									<div class="portlet-content">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
										<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
										<p>Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>
									</div>
								</div>
								
								<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
									<div class="portlet-header">Dummy content 4</div>
									<div class="portlet-content">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
										<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
										<p>Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>
									</div>
								</div>
							</div>
							<!-- End of Column two -->
							
							<!-- Column three -->
							<div class="cols3 column">
								<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
									<div class="portlet-header">Dummy content 3</div>
									<div class="portlet-content">
										<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
										<p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>
										<p>Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>
									</div>
								</div>
							</div>
							<!-- End of Column three -->
							
						</div>
						<!-- End of Three columns content -->
					</div>
					
					<hr />
					
					<h1>Tabs (Forms, Tables, Icons and Buttons)</h1>
					<div class="pad20">
					
						<!-- Tabs -->
						<div id="tabs">
							<ul>
								<li><a href="#tabs-1">Forms Preview</a></li>
								<li><a href="#tabs-2">Tables</a></li>
								<li><a href="#tabs-3">Framework Icons &amp; Buttons</a></li>
							</ul>
							
							<!-- First tab -->
							<div id="tabs-1">
									<!-- Form -->
									<form method="post" action="#">
										<!-- Fieldset -->
										<fieldset>
											<legend>This is a simple fieldset</legend>
											<p>
												<label for="sf">Small field: </label>
												<input class="sf" name="sf" type="text" value="small input field" />
												<span class="field_desc">Field description</span>
											</p>
											<p>
												<label for="mf">Medium Field: </label>
 												<input class="mf" name="mf" type="text" value="medium input field" /> <span class="validate_success">A positive message!</span>
											</p>
											<p>
												<label for="lf">Large Field: </label>
 												<input class="lf" name="lf" type="text" value="large input field" /> <span class="validate_error">A negative message!</span>
											</p>
											<p>
												<label>Linecheckboxes: </label>
												<input type="checkbox" />Lorem Ipsum
												<input type="checkbox" />Lorem Ipsum
												<input type="checkbox" />Lorem Ipsum
												<input type="checkbox" />Lorem Ipsum
											</p>
											<p>
												<label for="dropdown">DropDown: </label>
												<select name="dropdown" class="dropdown">
													<option>Please select an option</option>
													<option>Upload</option>
													<option>Change</option>
													<option>Remove</option>
												</select>
											</p>
											<p>
												<label>Vertical:</label>
												<div class="inpcol">
													<p><input type="checkbox" />Lorem Ipsum</p>
													<p><input type="checkbox" />Lorem Ipsum</p>
													<p><input type="checkbox" />Lorem Ipsum</p>
													<p><input type="checkbox" />Lorem Ipsum</p>
												</div>
												<div class="inpcol">
													<p><input type="radio" />Lorem Ipsum</p>
													<p><input type="radio"/>Lorem Ipsum</p>
													<p><input type="radio" />Lorem Ipsum</p>
													<p><input type="radio" />Lorem Ipsum</p>
												</div>
											</p>
											<p>
												<!-- WYSIWYG editor -->
												<textarea cols="200" style="width:100%"></textarea>
												<!-- End of WYSIWYG editor -->
											</p>
											<p>
												<input class="button" type="submit" value="Submit" />
												<input class="button" type="reset" value="Reset" />
											</p>
										</fieldset>
										<!-- End of fieldset -->
									</form>
									<!-- End of Form -->	
									<p>Proin vel ullamcorper purus. Pellentesque accumsan magna volutpat lacus volutpat quis lacinia metus vehicula. In hac habitasse platea dictumst. Aenean lorem mauris, iaculis sit amet condimentum luctus, volutpat ac nunc. Pellentesque cursus, eros ac lobortis dignissim, diam tortor malesuada lorem, cursus tempus dui sapien hendrerit mi. Nulla facilisi. Nulla facilisi. Fusce tincidunt dui sed eros interdum vel dignissim enim tempus. Vestibulum massa ipsum, volutpat eget blandit ac, semper eu dui. Nam eget mi sapien. </p>
								</div>
								<!-- End of First tab -->
								
								<!-- Second tab -->
								<div id="tabs-2">
									<p>A simple full width table</p>
									<p>Cras adipiscing, nisl ut rutrum vulputate, risus eros tincidunt justo, pellentesque dapibus elit massa vel risus. Nulla ac leo in ipsum sodales malesuada. Cras sit amet est nisl, at tristique augue. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
									<table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
										<thead>
											<tr>
												<td><input type="checkbox" class="checkall" /></td>
												<td>Name</td>
												<td>E-Mail</td>
												<td>Birthdate</td>
											</tr>
										</thead>
												<tbody>
													<tr>
													<td><input type="checkbox" /></td>
													<td>Johnatan Doe</td>
													<td>johndoe@someservice.web</td>
													<td>28/09/1978</td>
													</tr>
												</tbody>
									</table>
									<p>This is a normal table, content defines its width.</p>
									<table class="normal" cellpadding="0" cellspacing="0" border="0">
										<thead>
											<tr>
												<td>No.</td>
												<td>Image</td>
												<td>E-mail</td>
												<td>Name</td>
												<td>Submission date</td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td><img src="images/1.jpg" alt="" /></td>
												<td>johndoe@something.web</td>
												<td>Johnatan Doe</td>
												<td>23/01/2010</td>
											</tr>
											<tr class="odd">
												<td>2</td>
												<td><img src="images/2.jpg" alt="" /></td>
												<td>johndoe@something.web</td>
												<td>Johnatan Doe</td>
												<td>23/01/2010</td>
											</tr>
											<tr>
												<td>3</td>
												<td><img src="images/3.jpg" alt="" /></td>
												<td>johndoe@something.web</td>
												<td>Johnatan Doe</td>
												<td>23/01/2010</td>
											</tr>
											<tr class="odd">
												<td>4</td>
												<td><img src="images/4.jpg" alt="" /></td>
												<td>johndoe@something.web</td>
												<td>Johnatan Doe</td>
												<td>23/01/2010</td>
											</tr>
										</tbody>
									</table>
								</div>
								<!-- End of Second tab -->
								
								<!-- Third tab -->
								<div id="tabs-3">
									<!-- Framework icons -->
									<ul id="icons" class="ui-widget ui-helper-clearfix">
		
										<li class="ui-state-default ui-corner-all" title=".ui-icon-carat-1-n"><span class="ui-icon ui-icon-carat-1-n"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-carat-1-ne"><span class="ui-icon ui-icon-carat-1-ne"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-carat-1-e"><span class="ui-icon ui-icon-carat-1-e"></span></li>
		
										<li class="ui-state-default ui-corner-all" title=".ui-icon-carat-1-se"><span class="ui-icon ui-icon-carat-1-se"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-carat-1-s"><span class="ui-icon ui-icon-carat-1-s"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-carat-1-sw"><span class="ui-icon ui-icon-carat-1-sw"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-carat-1-w"><span class="ui-icon ui-icon-carat-1-w"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-carat-1-nw"><span class="ui-icon ui-icon-carat-1-nw"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-carat-2-n-s"><span class="ui-icon ui-icon-carat-2-n-s"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-carat-2-e-w"><span class="ui-icon ui-icon-carat-2-e-w"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-triangle-1-n"><span class="ui-icon ui-icon-triangle-1-n"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-triangle-1-ne"><span class="ui-icon ui-icon-triangle-1-ne"></span></li>
		
										<li class="ui-state-default ui-corner-all" title=".ui-icon-triangle-1-e"><span class="ui-icon ui-icon-triangle-1-e"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-triangle-1-se"><span class="ui-icon ui-icon-triangle-1-se"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-triangle-1-s"><span class="ui-icon ui-icon-triangle-1-s"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-triangle-1-sw"><span class="ui-icon ui-icon-triangle-1-sw"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-triangle-1-w"><span class="ui-icon ui-icon-triangle-1-w"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-triangle-1-nw"><span class="ui-icon ui-icon-triangle-1-nw"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-triangle-2-n-s"><span class="ui-icon ui-icon-triangle-2-n-s"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-triangle-2-e-w"><span class="ui-icon ui-icon-triangle-2-e-w"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrow-1-n"><span class="ui-icon ui-icon-arrow-1-n"></span></li>
		
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrow-1-ne"><span class="ui-icon ui-icon-arrow-1-ne"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrow-1-e"><span class="ui-icon ui-icon-arrow-1-e"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrow-1-se"><span class="ui-icon ui-icon-arrow-1-se"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrow-1-s"><span class="ui-icon ui-icon-arrow-1-s"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrow-1-sw"><span class="ui-icon ui-icon-arrow-1-sw"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrow-1-w"><span class="ui-icon ui-icon-arrow-1-w"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrow-1-nw"><span class="ui-icon ui-icon-arrow-1-nw"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrow-2-n-s"><span class="ui-icon ui-icon-arrow-2-n-s"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrow-2-ne-sw"><span class="ui-icon ui-icon-arrow-2-ne-sw"></span></li>
		
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrow-2-e-w"><span class="ui-icon ui-icon-arrow-2-e-w"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrow-2-se-nw"><span class="ui-icon ui-icon-arrow-2-se-nw"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowstop-1-n"><span class="ui-icon ui-icon-arrowstop-1-n"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowstop-1-e"><span class="ui-icon ui-icon-arrowstop-1-e"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowstop-1-s"><span class="ui-icon ui-icon-arrowstop-1-s"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowstop-1-w"><span class="ui-icon ui-icon-arrowstop-1-w"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowthick-1-n"><span class="ui-icon ui-icon-arrowthick-1-n"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowthick-1-ne"><span class="ui-icon ui-icon-arrowthick-1-ne"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowthick-1-e"><span class="ui-icon ui-icon-arrowthick-1-e"></span></li>
		
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowthick-1-se"><span class="ui-icon ui-icon-arrowthick-1-se"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowthick-1-s"><span class="ui-icon ui-icon-arrowthick-1-s"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowthick-1-sw"><span class="ui-icon ui-icon-arrowthick-1-sw"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowthick-1-w"><span class="ui-icon ui-icon-arrowthick-1-w"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowthick-1-nw"><span class="ui-icon ui-icon-arrowthick-1-nw"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowthick-2-n-s"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowthick-2-ne-sw"><span class="ui-icon ui-icon-arrowthick-2-ne-sw"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowthick-2-e-w"><span class="ui-icon ui-icon-arrowthick-2-e-w"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowthick-2-se-nw"><span class="ui-icon ui-icon-arrowthick-2-se-nw"></span></li>
		
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowthickstop-1-n"><span class="ui-icon ui-icon-arrowthickstop-1-n"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowthickstop-1-e"><span class="ui-icon ui-icon-arrowthickstop-1-e"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowthickstop-1-s"><span class="ui-icon ui-icon-arrowthickstop-1-s"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowthickstop-1-w"><span class="ui-icon ui-icon-arrowthickstop-1-w"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowreturnthick-1-w"><span class="ui-icon ui-icon-arrowreturnthick-1-w"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowreturnthick-1-n"><span class="ui-icon ui-icon-arrowreturnthick-1-n"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowreturnthick-1-e"><span class="ui-icon ui-icon-arrowreturnthick-1-e"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowreturnthick-1-s"><span class="ui-icon ui-icon-arrowreturnthick-1-s"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowreturn-1-w"><span class="ui-icon ui-icon-arrowreturn-1-w"></span></li>
		
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowreturn-1-n"><span class="ui-icon ui-icon-arrowreturn-1-n"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowreturn-1-e"><span class="ui-icon ui-icon-arrowreturn-1-e"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowreturn-1-s"><span class="ui-icon ui-icon-arrowreturn-1-s"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowrefresh-1-w"><span class="ui-icon ui-icon-arrowrefresh-1-w"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowrefresh-1-n"><span class="ui-icon ui-icon-arrowrefresh-1-n"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowrefresh-1-e"><span class="ui-icon ui-icon-arrowrefresh-1-e"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrowrefresh-1-s"><span class="ui-icon ui-icon-arrowrefresh-1-s"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrow-4"><span class="ui-icon ui-icon-arrow-4"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-arrow-4-diag"><span class="ui-icon ui-icon-arrow-4-diag"></span></li>
		
										<li class="ui-state-default ui-corner-all" title=".ui-icon-extlink"><span class="ui-icon ui-icon-extlink"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-newwin"><span class="ui-icon ui-icon-newwin"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-refresh"><span class="ui-icon ui-icon-refresh"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-shuffle"><span class="ui-icon ui-icon-shuffle"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-transfer-e-w"><span class="ui-icon ui-icon-transfer-e-w"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-transferthick-e-w"><span class="ui-icon ui-icon-transferthick-e-w"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-folder-collapsed"><span class="ui-icon ui-icon-folder-collapsed"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-folder-open"><span class="ui-icon ui-icon-folder-open"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-document"><span class="ui-icon ui-icon-document"></span></li>
		
										<li class="ui-state-default ui-corner-all" title=".ui-icon-document-b"><span class="ui-icon ui-icon-document-b"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-note"><span class="ui-icon ui-icon-note"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-mail-closed"><span class="ui-icon ui-icon-mail-closed"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-mail-open"><span class="ui-icon ui-icon-mail-open"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-suitcase"><span class="ui-icon ui-icon-suitcase"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-comment"><span class="ui-icon ui-icon-comment"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-person"><span class="ui-icon ui-icon-person"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-print"><span class="ui-icon ui-icon-print"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-trash"><span class="ui-icon ui-icon-trash"></span></li>
		
										<li class="ui-state-default ui-corner-all" title=".ui-icon-locked"><span class="ui-icon ui-icon-locked"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-unlocked"><span class="ui-icon ui-icon-unlocked"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-bookmark"><span class="ui-icon ui-icon-bookmark"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-tag"><span class="ui-icon ui-icon-tag"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-home"><span class="ui-icon ui-icon-home"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-flag"><span class="ui-icon ui-icon-flag"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-calculator"><span class="ui-icon ui-icon-calculator"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-cart"><span class="ui-icon ui-icon-cart"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-pencil"><span class="ui-icon ui-icon-pencil"></span></li>
				
										<li class="ui-state-default ui-corner-all" title=".ui-icon-clock"><span class="ui-icon ui-icon-clock"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-disk"><span class="ui-icon ui-icon-disk"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-calendar"><span class="ui-icon ui-icon-calendar"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-zoomin"><span class="ui-icon ui-icon-zoomin"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-zoomout"><span class="ui-icon ui-icon-zoomout"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-search"><span class="ui-icon ui-icon-search"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-wrench"><span class="ui-icon ui-icon-wrench"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-gear"><span class="ui-icon ui-icon-gear"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-heart"><span class="ui-icon ui-icon-heart"></span></li>
		
										<li class="ui-state-default ui-corner-all" title=".ui-icon-star"><span class="ui-icon ui-icon-star"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-link"><span class="ui-icon ui-icon-link"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-cancel"><span class="ui-icon ui-icon-cancel"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-plus"><span class="ui-icon ui-icon-plus"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-plusthick"><span class="ui-icon ui-icon-plusthick"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-minus"><span class="ui-icon ui-icon-minus"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-minusthick"><span class="ui-icon ui-icon-minusthick"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-close"><span class="ui-icon ui-icon-close"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-closethick"><span class="ui-icon ui-icon-closethick"></span></li>
			
										<li class="ui-state-default ui-corner-all" title=".ui-icon-key"><span class="ui-icon ui-icon-key"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-lightbulb"><span class="ui-icon ui-icon-lightbulb"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-scissors"><span class="ui-icon ui-icon-scissors"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-clipboard"><span class="ui-icon ui-icon-clipboard"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-copy"><span class="ui-icon ui-icon-copy"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-contact"><span class="ui-icon ui-icon-contact"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-image"><span class="ui-icon ui-icon-image"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-video"><span class="ui-icon ui-icon-video"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-script"><span class="ui-icon ui-icon-script"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-alert"><span class="ui-icon ui-icon-alert"></span></li>
		
										<li class="ui-state-default ui-corner-all" title=".ui-icon-info"><span class="ui-icon ui-icon-info"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-notice"><span class="ui-icon ui-icon-notice"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-help"><span class="ui-icon ui-icon-help"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-check"><span class="ui-icon ui-icon-check"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-bullet"><span class="ui-icon ui-icon-bullet"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-radio-off"><span class="ui-icon ui-icon-radio-off"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-radio-on"><span class="ui-icon ui-icon-radio-on"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-pin-w"><span class="ui-icon ui-icon-pin-w"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-pin-s"><span class="ui-icon ui-icon-pin-s"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-play"><span class="ui-icon ui-icon-play"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-pause"><span class="ui-icon ui-icon-pause"></span></li>
		
										<li class="ui-state-default ui-corner-all" title=".ui-icon-seek-next"><span class="ui-icon ui-icon-seek-next"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-seek-prev"><span class="ui-icon ui-icon-seek-prev"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-seek-end"><span class="ui-icon ui-icon-seek-end"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-seek-first"><span class="ui-icon ui-icon-seek-first"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-stop"><span class="ui-icon ui-icon-stop"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-eject"><span class="ui-icon ui-icon-eject"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-volume-off"><span class="ui-icon ui-icon-volume-off"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-volume-on"><span class="ui-icon ui-icon-volume-on"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-power"><span class="ui-icon ui-icon-power"></span></li>
		
										<li class="ui-state-default ui-corner-all" title=".ui-icon-signal-diag"><span class="ui-icon ui-icon-signal-diag"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-signal"><span class="ui-icon ui-icon-signal"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-battery-0"><span class="ui-icon ui-icon-battery-0"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-battery-1"><span class="ui-icon ui-icon-battery-1"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-battery-2"><span class="ui-icon ui-icon-battery-2"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-battery-3"><span class="ui-icon ui-icon-battery-3"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-circle-plus"><span class="ui-icon ui-icon-circle-plus"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-circle-minus"><span class="ui-icon ui-icon-circle-minus"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-circle-close"><span class="ui-icon ui-icon-circle-close"></span></li>
		
										<li class="ui-state-default ui-corner-all" title=".ui-icon-circle-triangle-e"><span class="ui-icon ui-icon-circle-triangle-e"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-circle-triangle-s"><span class="ui-icon ui-icon-circle-triangle-s"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-circle-triangle-w"><span class="ui-icon ui-icon-circle-triangle-w"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-circle-triangle-n"><span class="ui-icon ui-icon-circle-triangle-n"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-circle-arrow-e"><span class="ui-icon ui-icon-circle-arrow-e"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-circle-arrow-s"><span class="ui-icon ui-icon-circle-arrow-s"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-circle-arrow-w"><span class="ui-icon ui-icon-circle-arrow-w"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-circle-arrow-n"><span class="ui-icon ui-icon-circle-arrow-n"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-circle-zoomin"><span class="ui-icon ui-icon-circle-zoomin"></span></li>
		
										<li class="ui-state-default ui-corner-all" title=".ui-icon-circle-zoomout"><span class="ui-icon ui-icon-circle-zoomout"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-circle-check"><span class="ui-icon ui-icon-circle-check"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-circlesmall-plus"><span class="ui-icon ui-icon-circlesmall-plus"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-circlesmall-minus"><span class="ui-icon ui-icon-circlesmall-minus"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-circlesmall-close"><span class="ui-icon ui-icon-circlesmall-close"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-squaresmall-plus"><span class="ui-icon ui-icon-squaresmall-plus"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-squaresmall-minus"><span class="ui-icon ui-icon-squaresmall-minus"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-squaresmall-close"><span class="ui-icon ui-icon-squaresmall-close"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-grip-dotted-vertical"><span class="ui-icon ui-icon-grip-dotted-vertical"></span></li>
		
										<li class="ui-state-default ui-corner-all" title=".ui-icon-grip-dotted-horizontal"><span class="ui-icon ui-icon-grip-dotted-horizontal"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-grip-solid-vertical"><span class="ui-icon ui-icon-grip-solid-vertical"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-grip-solid-horizontal"><span class="ui-icon ui-icon-grip-solid-horizontal"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-gripsmall-diagonal-se"><span class="ui-icon ui-icon-gripsmall-diagonal-se"></span></li>
										<li class="ui-state-default ui-corner-all" title=".ui-icon-grip-diagonal-se"><span class="ui-icon ui-icon-grip-diagonal-se"></span></li>
									</ul>
									<!-- End of Framework Icons -->
									<p>This icons can be used for buttons, header buttons, etc.</p>
									<p>Buttons made with these icons: </p>
									<p><a href="#" class="button tooltip" title="This is a random button"><span class="ui-icon ui-icon-trash"></span>Remove</a><a href="#" class="button"><span class="ui-icon ui-icon-radio-off"></span>Radio off</a><a href="#" class="button"><span class="ui-icon ui-icon-play"></span>Play</a></p>
								</div>
								<!-- End of Third tab -->
							</div>
							<!-- End of Tabs -->
						</div>
						
						<hr />
						
						<h1>Sliders, Progressbar, Dialogs!</h1>
						<div class="pad20">
							<p><a href="#" class="button tooltip" title="Click me to open the dialog!" id="dialog_link"><span class="ui-icon ui-icon-newwin"></span>Open Dialog</a></p>
							<!-- Dialog -->
							<div id="dialog" title="Welcome message!">
								<p>Welcome to <b>Wide Admin</b>!</p>
								<p>Wide Admin is one powerful customizable backend user interface. Check the demo to see what it can do!</p>
								<p>And this is a custom message text that you can modify to fit your needs.</p>
							</div>
							<!-- End of Dialog -->
			
							<h2 class="demoHeaders">Slider</h2>
							<!-- Slider -->
							<div id="slider"></div>
							<!-- End of Slider -->
							
							<h2 class="demoHeaders">Progressbar</h2>
							<!-- Progressbar -->	
							<div id="progressbar"></div>
							<!-- End of Progressbar -->
							
						</div>	
						<?php endif; ?>
					</div>
					
				</div>
				<!-- End of Main Content -->
				
				<!-- Sidebar -->
				<div id="sidebar">
				
					<h2>Accordion</h2>
					<!-- Accordion -->
					<div id="accordion">
						<div>
							<h3><a href="#" title="First slide" class="tooltip">First</a></h3>
							<div>Praesent augue urna, vehicula sed sollicitudin quis, dignissim nec est. Quisque dignissim lorem at metus vehicula ut feugiat eros vestibulum. Suspendisse ultrices, massa luctus aliquam faucibus, sem quam fermentum nisl, non posuere quam nunc vel tellus.</div>
						</div>
						<div>
							<h3><a href="#" title="Second slide" class="tooltip">Second</a></h3>
							<div>Sed sem elit, porttitor quis vestibulum ut, euismod id purus. Praesent vulputate dolor vel nisi mattis sollicitudin. Curabitur placerat quam at sem tempor ac sodales nunc dapibus. Nullam mi purus, adipiscing in facilisis sed, posuere ut ipsum.</div>
						</div>
						<div>
							<h3><a href="#" title="Third slide" class="tooltip">Third</a></h3>
							<div>Praesent augue urna, vehicula sed sollicitudin quis, dignissim nec est. Quisque dignissim lorem at metus vehicula ut feugiat eros vestibulum. Suspendisse ultrices, massa luctus aliquam faucibus, sem quam fermentum nisl, non posuere quam nunc vel tellus.</div>
						</div>
					</div>
					<!-- End of Accordion-->
						
					<h2>Datepicker</h2>
					<!-- Datepicker -->
					<div id="datepicker"></div>
					<!-- End of Datepicker -->
				
					<!-- Sortable Dialogs -->
					<h2>Sortable Dialogs</h2>
					<div class="sort">
						<div class="box ui-widget ui-widget-content ui-corner-all portlet">
						<div class="portlet-header">Sortable 1</div>
							<div class="portlet-content">
								<p>This is a sortable dialog. Praesent augue urna, vehicula sed sollicitudin quis, dignissim nec est.</p>
							</div>
						</div>
						
						<div class="box ui-widget ui-widget-content ui-corner-all portlet">
							<div class="portlet-header">Sortable 2</div>
							<div class="portlet-content">
								<p>This is a sortable dialog. Praesent augue urna, vehicula sed sollicitudin quis, dignissim nec est.</p>
							</div>
						</div>
						
						<div class="box ui-widget ui-widget-content ui-corner-all portlet">
							<div class="portlet-header">Sortable 3</div>
							<div class="portlet-content">
								<p>This is a sortable dialog. Praesent augue urna, vehicula sed sollicitudin quis, dignissim nec est.</p>
							</div>
						</div>
					</div>
					<!-- End of Sortable Dialogs -->
					
					<!-- Lists -->
					<h2>Lists / Navigation</h2>
					<ul>
						<li><a href="">Lorem Ipsum</a></li>
						<li><a href="">Artificial Intelligence</a></li>
						<li><a href="">jQuery Power</a>
							<ul>
								<li><a href="">Lorem Ipsum</a></li>
								<li><a href="">Artificial Intelligence</a></li>
								<li><a href="">Lorem Ipsum</a>
									<ul>
										<li><a href="">Lorem Ipsum</a></li>
										<li><a href="">Artificial Intelligence</a></li>
										<li><a href="">Lorem Ipsum</a></li>
										<li class="last"><a href="">Artificial Intelligence</a></li>
									</ul>
								</li>
								<li class="last"><a href="">Artificial Intelligence</a></li>
							</ul>
						</li>
						<li><a href="">Another category</a></li>
					</ul>
					<!-- End of Lists -->
					
					<!-- Statistics -->
					<h2>Statistics</h2>
					<p><b>Articles:</b> 2201</p>
					<p><b>Comments:</b> 17092</p>
					<p><b>Users:</b> 3788</p>
					<!-- End of Statistics -->
				
				</div>
				<!-- End of Sidebar -->
				
			</div>
			<!-- End of bgwrap -->
		</div>
		<!-- End of Container -->
		
		<!-- Footer -->
		<div id="footer">
			<p class="mid">
				<a href="#" title="Top" class="tooltip">Top</a>&middot;<a href="#" title="Main Page" class="tooltip">Home</a>&middot;<a href="#" title="Change current settings" class="tooltip">Settings</a>&middot;<a href="#" title="End administrator session" class="tooltip">Logout</a>
			</p>
			<p class="mid">
				<!-- Change this to your own once purchased -->
				&copy; Wide Admin 2010. All rights reserved.
				<!-- -->
			</p>
		</div>
		<!-- End of Footer -->


	</body>
</html>


