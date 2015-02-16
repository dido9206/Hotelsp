<?php
require_once('php/include.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
	<meta charset="UTF-8">
	<title>o'Хотели - Хотелски резервации</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<script src="jquery-1.9.1.js" type="text/javascript"></script>
	<script src="jquery-ui-1.10.3.custom.js" type="text/javascript"></script>
	<script type="text/javascript" src="jquery-ui-1.10.3.custom.min"></script>
	<script type="text/javascript" src="fancybox/jquery.fancybox.pack.js"></script>
	<link rel="stylesheet" href="fancybox/jquery.fancybox.css" type="text/css" media="screen" />
</head>
<script>
	$(document).ready(function() {
		hotelList('news','name');
		$("a.single_image").fancybox();
		$('#sort').change(function(){
			hotelList('news',$('#sort').val());
		});
	});
	$("a#inline").fancybox({
		'hideOnContentClick': true
	});
	function hotelList(method,sort){
		var searchHotel = $('#searchHotel').val();
		var sort = $('#sort').val();
		
		$.post(
			"php/show_hotels.php",
			{searchHotel: searchHotel,
			 sort:sort},
			function (data)
			{
				$('#'+method).html(data);
			}
		);
	
		return false; 
	}
	
	function showHotel(id){
		 $.post(
			"php/view_hotel.php",
			{id: id},
			function (data)
			{
				$("#news").html(data);
			}
		);
		
	}
	
	
</script>
<body>
	<div id="header">
		<div>
			<div class="logo">
				<a href="index.php"> Хотели</a>
			</div>
			<ul id="navigation">
				<li>
					<a href="index.php">Начало</a>
				</li>
				<li class="active">
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
	<div id="contents">
		<div class="main">
			<div class="search_panel">
				<input type="text" name="search" size="40" id="searchHotel" class="searchfield" />
				<button type="button" class="btn btn-success" onclick="hotelList('news','name');">Търси</button> 
				Сортирай по:<select name="sort" id="sort" required >
					  			<option value="name">Име</option>
					  			<option value="city">Град</option>
					  			<option value="stars">Звезди</option>
							</select><br/>
			</div>
			<ul id="news" class="news">	
			</ul>
		</div>
		<div class="sidebar">
			<h2>Най-популярни</h2>
			<ul class="posts">
				<li>
					<h4 class="title"><a href="post.html">Хотел1</a></h4>
					<p>
						Информация за хотел 1. сдасадфасф саф сдфсф сад сдаф садф садфсадф саФАС ДФАСАДФ САД ФСАД СДАФДСФСДФСДфсгф дфгсдфсд.
					</p>
				</li>
				<li>
					<h4 class="title"><a href="post.html">Хотел2</a></h4>
					<p>
						Информация за хотел 1. сдасадфасф саф сдфсф сад сдаф садф садфсадф саФАС ДФАСАДФ САД ФСАД СДАФДСФСДФСДфсгф дфгсдфсд.
					</p>
				</li>
				<li>
					<h4 class="title"><a href="post.html">Хотел3</a></h4>
					<p>
						Информация за хотел 1. сдасадфасф саф сдфсф сад сдаф садф садфсадф саФАС ДФАСАДФ САД ФСАД СДАФДСФСДФСДфсгф дфгсдфсд.
					</p>
				</li>
			</ul>
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