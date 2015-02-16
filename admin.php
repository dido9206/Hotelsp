<?php
require_once('php/include.php');
if($_SESSION['logged-in'] == true){header('Location: adminpanel.php');}


$error = '';

$form = $_POST['submit'];

$username = mysql_real_escape_string($_POST['username']);

$password = md5(mysql_real_escape_string($_POST['password']));

if( isset($form) ) {

if( isset($username) && isset($password) && $username !== '' && $password !== '' ) {


$sql = mysql_query("SELECT * FROM `admin` WHERE username='$username' and
password='$password';");

if( mysql_num_rows($sql) != 0 ) { //success

$_SESSION['logged-in'] = true;
$_SESSION['user_hash'] = md5($username);

header('Location: adminpanel.php');

exit;

} else { $error = "Грешно име или парола!"; }

} else { $error = 'Моля попълнете всички поета!';}

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
				<a href="index.php"> Хотели</a>
			</div>
			<ul id="navigation">
				<li class="active">
					<a href="index.php">Начало</a>
				</li>
				<li>
					<a href="search.php">Хотели</a>
				</li>

			</ul>
		</div>
	</div>
	<div id="adbox">
		<div class="clearfix">
			<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
		    	<tr>
		   			<form action="<?php $PHP_SELF; ?>" method="post" >
					<td>
					<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
						<tr>
							<td colspan="3"><strong>Админ Вход </strong></td>
						</tr>
						<tr>
							<td width="78">Име</td>
							<td width="6">:</td>
							<td width="294"><input name="username" type="text" value="<?php echo "$username";?>" /></td>
						</tr>
						<tr>
							<td>Парола</td>
							<td>:</td>
							<td><input name="password" type="password" /></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><input type="submit" name="submit" value="Влез"></td>
						</tr>
					</table>
					</td>
					</form>
					<?php
						echo "<br /><span style=\"color:red;text-align: center;\">$error</span>";
					?>
				</tr>
			</table>
  				
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
