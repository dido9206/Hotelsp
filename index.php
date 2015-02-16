<?php
require_once('php/include.php');
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>o'Хотели - Хотелски резервации</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
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
				<?php
						if($_SESSION['logged-in'] == true)
						echo "<li>
								<a href='admin.php' > [Админ панел] </a>
							  </li>
							  <li>
								<a href='php/logout.php'>[Изход]</a>
							   </li>";
				?>
			</ul>
		</div>
	</div>
	<div id="adbox">
		<div class="clearfix">
			<img src="images/box2.gif" alt="Img" height="342" width="368">
			<div>
				<h2>Управление на Хотели</h2>
				<p>
					<span><a href="search.php" class="btn">Търси Хотели</a></span>
				</p>
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