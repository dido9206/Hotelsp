<?php  
session_start();
 $id = $_POST['id'];
 $signature = $_SESSION['user_hash'];
 $con=mysqli_connect("localhost","root","1qazZAQ!","hotels");
	
	if (mysqli_connect_errno($con))
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	
	//var_dump($_POST);
	$sql="DELETE FROM `hotel` PARTITION (".$signature.") WHERE `hotel`.`id` = ".$id." LIMIT 1;";
		  
	$result = mysqli_query($con,$sql);
	
	if (!$result)
  	{
  		die('Неуспешно изтриване' . mysqli_error($con));
  	}
	echo "Успешно изтрихте хотела!";
	$sql = "ALTER TABLE room DROP PARTITION h".$id;
	mysqli_query($con,$sql);
	mysqli_close($con);

  
?> 