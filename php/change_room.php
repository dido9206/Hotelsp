<?php  
 $id = $_POST['id'];
 $con=mysqli_connect("localhost","root","1qazZAQ!","hotels");
	
	if (mysqli_connect_errno($con))
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	
	//var_dump($_POST);
	$sql="SELECT * FROM room WHERE id = ".$id." LIMIT 1;";
	$result = mysqli_query($con,$sql);
	
	while($row = mysqli_fetch_array($result))
  	{
 		echo json_encode(array("hotel_id"=>$row['hotel_id'],"numbeds"=>$row['numbeds'],"view" =>$row['view'],"hasbath"=>$row['havebathroom'],"price"=>$row['price']));
  	}
	mysqli_close($con);

  
?> 