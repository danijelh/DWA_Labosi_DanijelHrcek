<?php
	session_start();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php

	$_SESSION["username"] = "";
	
	
    header('Location: login.html');

?>
	
</body>
</html>