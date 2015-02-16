<?php  
 $id = $_POST['id'];
 $con=mysqli_connect("localhost","root","1qazZAQ!","hotels");
	
	if (mysqli_connect_errno($con))
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	
	//var_dump($_POST);
	$sql="SELECT * FROM room PARTITION (h".$id.")";
		  
	$result = mysqli_query($con,$sql);
	
	while($row = mysqli_fetch_array($result))
  	{
  		echo "<option value=\"".$row['id']."\">".$row['numbeds']." легла, ".$row['view']." гледка, ".$row['price']."лв.</option>";		
  	}

	mysqli_close($con);

  
?> 