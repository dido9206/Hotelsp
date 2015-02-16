<?php  
session_start();
 $searchHotel = $_POST['searchHotel'];
 $signature = $_SESSION['user_hash'];
 $con=mysqli_connect("localhost","root","1qazZAQ!","hotels");
	
	if (mysqli_connect_errno($con))
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	
	//var_dump($_POST);
	$sql="SELECT * FROM Hotel PARTITION (".$signature.") WHERE name LIKE('%".$searchHotel."%')";
		  
	$result = mysqli_query($con,$sql);
	
	while($row = mysqli_fetch_array($result))
  	{
  		echo "<option value=\"".$row['id']."\">".$row['name'].", ".$row['city'].", ".$row['address']."</option>";		
  	}

	mysqli_close($con);

  
?> 