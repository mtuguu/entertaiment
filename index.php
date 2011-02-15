<?php
$base_url = "/khasaa/test/entertaiment/"; // хоёр талд нь слаштай бичнэ үү!
$url = substr($_SERVER['REQUEST_URI'], strlen($base_url));
preg_match("|(?P<action>\w*)/?(?P<argument>\d*)|i", $url, $request);

function index() {
	echo "<h2>Index haha</h2>";
}

function latest_work_type($id) {
	if($id)
		echo "<h2>Latest Work Type: " . $id . "</h2>";
	else
		echo "<h2>Latest Work Types</h2>";
}

function latest_work($id) {
}

function work_type() {
}

function gallery($id) {
}

function price() {
}

function explore() {
}

function contact() {
}

function news($id) {
}

function news_type($id) {
}

?>
<html>
	<head>
		<title>N-Entertaiment development</title>
	</head>
	<body>
		<h1>N-Entertainment development</h1>
<?php
if($request['action'] && $request['argument'])
	call_user_func($request['action'], $request['argument']);
else if($request['action'])
	call_user_func($request['action']);
else
	call_user_func('index');
?>

	</body>
</html>
