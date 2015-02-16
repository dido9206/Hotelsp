<?php

require_once('php/include.php');
// is the one accessing this page logged in or not?

if ( !isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {

// not logged in, move to login page

header('Location: admin.php');

exit;

}

?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>o'Хотели - Хотелски резервации</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<script src="jquery-1.9.1.js" type="text/javascript"></script>
	<script src="jquery-ui-1.10.3.custom.js" type="text/javascript"></script>
	<script>
  		$(function() {
    		$( "#tabs" ).tabs();
  		});
  	</script>
</head>
<body>
	<div id="header">
		<div>
			<div class="logo">
				<a href="index.php"> Хотели</a>
			</div>
			<ul id="navigation">
				<li class="active">
					<a href="index.php">Начало</a>
				</li>
				<li>
					<a href="search.php">Хотели</a>
				</li>
				<li>
					<a href="admin.php" > [Админ панел] </a>
				</li>
				<li>
					<a href="php/logout.php">[Изход]</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="adbox">
		<div class="clearfix">
			<div id="tabs">
  				<ul>
   				 	<li><a href="#tabs-1">Хотели</a></li>
   				 	<li><a href="#tabs-2">Стаи</a></li>
    				<li><a href="#tabs-3">Градове</a></li>
  				</ul>
  				<div id="tabs-1">
    				<?php require_once ('php/hotel_form.php'); ?>
  				</div>
  				<div id="tabs-2">
    				<?php require_once ('php/room_form.php'); ?>
  				</div>
  				<div id="tabs-3">
    				<?php require_once 'php/city_form.php';	 ?>
    			</div>
			</div>
		</div>
	</div>
	
	<div id="footer">
		<div class="clearfix">
			<div id="connect">
				<a href="https://www.facebook.com/delyan.damyanov.16" target="_blank" class="facebook"></a><a href="" target="_blank" class="googleplus"></a><a href="" target="_blank" class="twitter"></a><a href="" target="_blank" class="tumbler"></a>
			</div>
			<p>
				© Delyan Damyanov . All Rights Reserved.
			</p>
		</div>
	</div>
</body>
</html>