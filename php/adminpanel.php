<?php

require_once('include.php');

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
	<meta charset="UTF-8">
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
				<a href="index.html"> Хотели</a>
			</div>
			<ul id="navigation">
				<li class="active">
					<a href="index.html">Начало</a>
				</li>
				<li>
					<a href="news.html">Хотели</a>
				</li>
				<li>
					<a href="about.html">За нас</a>
				</li>
				<li>
					<a href="contact.html">Контакти</a>
				</li>
			</ul>
			<a href="adminpanel.php" > Админ панел </a>
			<a href="logout.php" > Излез </a>
		</div>
	</div>
	<div id="adbox">
		<div class="clearfix">
			<div id="tabs">
  				<ul>
   				 	<li><a href="#tabs-1">Хотели</a></li>
   				 	<li><a href="#tabs-2">Стаи</a></li>
    				<li><a href="#tabs-3">Градове</a></li>
    				<li><a href="#tabs-4">Резервации</а></li>
  				</ul>
  				<div id="tabs-1">
    				<?php require_once ('hotel_form.php'); ?>
  				</div>
  				<div id="tabs-2">
    				a
  				</div>
  				<div id="tabs-3">
    				<?php require_once 'city_form.php';	 ?>
    			</div>
    			<div id="tabs-4">
    				<?php require_once 'res_form.php'; ?>
    			</div>
			</div>
		</div>
	</div>
	
	<div id="footer">
		<div class="clearfix">
			<div id="connect">
				<a href="http://freewebsitetemplates.com/go/facebook/" target="_blank" class="facebook"></a><a href="http://freewebsitetemplates.com/go/googleplus/" target="_blank" class="googleplus"></a><a href="http://freewebsitetemplates.com/go/twitter/" target="_blank" class="twitter"></a><a href="http://www.freewebsitetemplates.com/misc/contact/" target="_blank" class="tumbler"></a>
			</div>
			<p>
				© Delyan Damyanov & Martin Petkov. All Rights Reserved.
			</p>
		</div>
	</div>
</body>
</html>