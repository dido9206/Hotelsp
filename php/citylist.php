<?php
	$con=mysqli_connect("localhost","root","1qazZAQ!","hotels");
	
	if (mysqli_connect_errno($con))
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	
	//var_dump($_POST);
	$sql="SELECT DISTINCT name FROM City ORDER BY name";
	$result = mysqli_query($con,$sql);
	echo "<option value='none';>[Избери]</option>";
	while($row = mysqli_fetch_array($result))
  	{
  		echo "<option value=\"".$row['name']."\">".$row['name']."</option>" ;
  	}
	mysqli_close($con);

	?>